<?php

namespace App\Http\Controllers\Staff\Settings;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Traits\Regular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class GeneralSettings extends BaseController
{
    use Regular;
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.settings.general_settings')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'General Settings',
            'user'      =>$user
        ]);
    }
    //process update
    public function processUpdate(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(),[
                'pin'=>['required','numeric'],
                'name'=>['required','string','max:150'],
                'email'=>['required','email','max:150'],
                'feedbackMail'=>['required','email','max:150'],
                'investorMail'=>['required','email','max:150'],
                'phone'=>['required','string','max:150'],
                'address'=>['required','string','max:200'],
                'description'=>['required','string','max:500'],
                'tagline'=>['required','string','max:150'],
                'keywords'=>['required','string','max:150'],
                'penaltyFee'=>['required','numeric'],
                'emailVerification'=>['required','numeric'],
                'currency'=>['required','string','max:150'],
                'codeExpire'=>['required','string','max:150'],
                'featuredFee'=>['required','numeric'],
                'refBonus'=>['required','numeric'],
                'affiliateCommission'=>['required','string','max:150'],
                'bookingAcceptanceTime'=>['required','string','max:150'],
                'clientTimeToApproveBooking'=>['required','string','max:150'],
                'supportInterveneTime'=>['required','string','max:150'],
                'subscriptionChargeRetry'=>['required','numeric','integer'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error',['error'=>$validator->errors()->all()]);

            $input = $validator->validated();

            $hashed = Hash::check($input['pin'],$user->accountPin);
            if (!$hashed){
                return $this->sendError('authentication.error',['error'=>'Invalid account pin']);
            }
           $web->name=$input['name'];
           $web->email=$input['email'];
           $web->feedbackMail=$input['feedbackMail'];
           $web->investorMail=$input['investorMail'];
           $web->phone=$input['phone'];
           $web->address=$input['address'];
           $web->description=$input['description'];
           $web->tagline=$input['tagline'];
           $web->keywords=$input['keywords'];
           $web->penaltyFee=$input['penaltyFee'];
           $web->emailVerification=$input['emailVerification'];
           $web->currency=$input['currency'];
           $web->codeExpire=$input['codeExpire'];
           $web->featuredFee=$input['featuredFee'];
           $web->refBonus=$input['refBonus'];
           $web->affiliateCommission=$input['affiliateCommission'];
           $web->bookingAcceptanceTime=$input['bookingAcceptanceTime'];
           $web->clientTimeToApproveBooking=$input['clientTimeToApproveBooking'];
           $web->supportInterveneTime=$input['supportInterveneTime'];
           $web->subscriptionChargeRetry=$input['subscriptionChargeRetry'];

           $web->save();

            $this->createStaffActivity('General Setting update','Staff updated General Settings',$user);
            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Setting successfully updated.');

        }catch (Exception $exception){
            Log::alert($exception->getMessage());
            return $this->sendError('error',['error'=>'Internal Server error']);
        }
    }
}
