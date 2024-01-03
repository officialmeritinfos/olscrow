<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Email;
use App\Models\Fiat;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Notifications\CustomNotification;
use App\Notifications\EmailVerification;
use App\Notifications\WelcomeEmail;
use App\Traits\Regular;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class Register extends BaseController
{
    use Regular;
    //landing page
    public function landingPage(Request $request)
    {
        $web = GeneralSetting::find(1);

        return view('auth.register')->with([
            'siteName'=>$web->name,
            'pageName'=>'Account Registration',
            'web'=>$web,
            'countries'=>Country::get(),
            'referral'=>$request->get('ref'),
            'refType'=>$request->get('type')
        ]);
    }
    //process registration
    public function processRegistration(Request $request)
    {
        try {
            $web = GeneralSetting::find(1);
            $user = Auth::user();
            //validate request
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'email' => ['required', 'email','unique:users,email'],
                'username' => ['required', 'alpha_num','unique:users,username'],
                'accountType' => ['required', 'numeric'],
                'country' => ['required', 'string','exists:countries,iso3'],
                'password' => ['required', Password::min(8)->uncompromised(1)],
                'password_confirmation'=>['required','same:password'],
                'gender'=>['required','alpha'],
                'dob'=>['required','date','before:-18 years'],
                'referral'=>['nullable','string','exists:user,username'],
                'refType'=>['nullable','numeric','in:1,2']
            ])->stopOnFirstFailure();

            if ($validator->fails()){
                return $this->sendError('validation.error',['error'=>$validator->errors()->all()]);
            }

            $input = $validator->validated();

            //check if the referral type is valid
            if ($request->filled('referral')){
                $referrer = User::where('username',$input['referral'])->where('refType',$input['refType'])->first();
                if (empty($referrer)){
                    return $this->sendError('referral.error',['error'=>'Invalid Referral']);
                }
                $refBy = $referrer->id;
            }else{
                $refBy=0;
            }

            $reference = $this->generateUniqueId('users','reference');
            //check if the selected country is valid
            $countryExists = Country::where(['iso3'=>$input['country'],'status'=>1])->first();
            if (empty($countryExists)) return $this->sendError('country.error',['error'=>'Unsupported region']);
            //check for main currency
            $fiat = Fiat::where('country',strtolower($countryExists->iso2))->orWhere('country','all')->first();

            $dataUser = [
                'name'=>$input['name'],
                'email'=>$input['email'],
                'username'=>$input['username'],
                'reference'=>$reference,
                'password'=>bcrypt($input['password']),
                'country'=>$countryExists->name,
                'countryCode'=>$countryExists->iso3,
                'phoneCode'=>ltrim($countryExists->phonecode,'+'),
                'mainCurrency'=>$fiat->code,
                'emailVerified'=>$web->emailVerification,
                'registrationIp'=>$request->ip(),
                'accountType'=>$input['accountType'],
                'gender'=>$input['gender'],
                'dateOfBirth'=>strtotime($input['dob']),
                'referral'=>$refBy,
                'referralType'=>$input['refType']
            ];
            //create user
            $user = User::create($dataUser);
            if (!empty($user)){
                $this->initializeUserSettings($user);//initialize settings
                //check for email verification and initiate it
                if ($web->emailVerification==1){
                    $urlTo = route('login');
                    $user->notify(new WelcomeEmail($user->name));

                    $message = ' Account successfully created.';
                }else{
                    Auth::login($user);
                    //send email verification
                    $user->notify(new EmailVerification($user));
                    $urlTo =route('email-verification');
                    $message = 'A code has been sent to your email. Verify your email to proceed.';
                }
                //notify referral
                if ($refBy!=0){
                    $mess = "A new sign-up was recorded on ".$web->name." using your referral link. You will receive your commission once user completes a transaction.";
                    $referrer->notify(new CustomNotification($referrer,$mess,'New Referral Signup'));
                }
                return $this->sendResponse([
                    'redirectTo'=>$urlTo
                ],$message);
            }
            return $this->sendError('account.error',['error'=>'Something went wrong']);
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
            return $this->sendError('account.error',['error'=>'Internal Server error.']);
        }
    }
    //email verification landing page
    public function emailVerification(): Factory|View|Application
    {
        $web = GeneralSetting::find(1);

        $dataView = [
            'pageName' => 'Email Verification',
            'siteName' => $web->name,
            'web'      => $web
        ];
        return view('auth.email_verification',$dataView);
    }

    //process email verification
    public function processEmailVerification(Request $request): JsonResponse
    {
        try {
            $web = GeneralSetting::find(1);
            $user = Auth::user();
            //validate request
            $validator = Validator::make($request->all(), [
                'code' => ['required', 'digits:6'],
            ])->stopOnFirstFailure();

            if ($validator->fails()){
                return $this->sendError('validation.error',['error'=>$validator->errors()->all()]);
            }
            $input = $validator->validated();

            $codeExists = Email::where(['user'=>$user->id,'email'=>$user->email])->orderBy('id','desc')->first();
            if (empty($codeExists)) return $this->sendError('token.error',['error'=>'Unidentified token']);

            if (time()>$codeExists->codeExpire)return $this->sendError('token.error',['error'=>'Token timedout.']);

            $hashed = Hash::check($input['code'],$codeExists->token);
            if (!$hashed) return $this->sendError('token.error',['error'=>'Invalid token entered']);

            //update user
            $dataUser = [
                'emailVerified'=>1,
                'email_verified_at'=>$this->getCurrentDateTimeString()
            ];

            if (User::where('id',$user->id)->update($dataUser)){
                $user->notify(new WelcomeEmail($user->name));
                Email::where('user',$user->id)->delete();

                Auth::logout();
                $request->session()->regenerate();

                return $this->sendResponse([
                    'redirectTo'=>route('login'),
                    'token'=>$request->bearerToken()
                ],'Email successfully verified.');
            }
            return $this->sendError('account.error',['error'=>'Unable to verify email']);
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
            return $this->sendError('error',['error'=>'Internal Server error']);
        }
    }
}
