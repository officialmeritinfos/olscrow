<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\GeneralSetting;
use App\Notifications\CustomNotification;
use App\Traits\Flutterwave;
use App\Traits\Regular;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use SebastianBergmann\Diff\Exception;

class Dashboard extends BaseController
{
    use Regular;
    //landing page
    public function landingPage()
    {
        $user = Auth::user();
        if ($user->accountType==1){
            $type ='Escort';
        }else{
            $type = 'User';
        }
        $web = GeneralSetting::find(1);

        return view('dashboard.home')->with([
            'web'=>$web,
            'pageName'=>$type.' Dashboard',
            'type'=>$type,
            'siteName'=>$web->name,
            'user'=>$user
        ]);
    }
    //send otp
    public function sendOtp()
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);

            $otp = $this->generateToken('users','reference');

            $user->otp = bcrypt($otp);
            $user->otpExpires =strtotime($web->codeExpire,time());


            $message = "There is a new request on your account requiring an OTP. The OTP to use is <b>".$otp."</b>.
            <p>This OTP will expire in <b>".$web->codeExpire."</b>. Note that neither ".$web->name." nor her staff will ever ask you for your OTP.";

            $user->notify(new CustomNotification($user,$message,'OTP Authentication'));
            $user->save();
            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'An OTP has been sent to your registered mail. Please use it to authenticate this action.');

        }catch (ThrottleRequestsException $exception){
            return $this->sendError('otp.error',['error'=>'You can only request for OTP once every minute. Please wait.']);
        }catch (\Exception $exception){
            Log::info('Error on '.$exception->getFile().' on line '.$exception->getLine().': '.$exception->getMessage());
            return $this->sendError('otp.error',['error'=>'Internal Server error; we are working on this now']);
        }
    }
    //get banks in country
    public function getCountryBanks()
    {
        try {
            $user = Auth::user();
            $countryCode = $user->countryCode;
            $country = Country::where('iso3',$countryCode)->first();
            $client = new Flutterwave();
            $response = $client->fetchBank($country->iso2);
            if ($response->ok()){
                $res = $response->json();

                return $this->sendResponse([
                    'banks'=>$res['data']
                ],'Banks retrieved.');

            }else{
                return $this->sendError('bank.error',['error'=>'There was an error retrieving banks']);
            }
        }catch (\Exception $exception){
            Log::info($exception->getMessage());
            return $this->sendError('bank.error',['error'=>'An internal server error occurred']);
        }

    }
}
