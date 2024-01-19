<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\BaseController;
use App\Models\GeneralSetting;
use App\Models\UserActivity;
use App\Traits\Regular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class Home extends BaseController
{
    use Regular;
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.home')->with([
           'web'       =>$web,
           'siteName'  =>$web->name,
           'pageName'  =>'Staff Dashboard',
           'user'      =>$user
        ]);
    }
    //set account pin
    public function setPin(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(),[
                'pin'=>['required','numeric','confirmed', 'digits:6'],
                'pin_confirmation'=>['required','numeric','digits:6'],
                'password'=>['required','current_password:web'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error',['error'=>$validator->errors()->all()]);

            $input = $validator->validated();

            $user->setPin=1;
            $user->accountPin = bcrypt($input['pin']);
            $user->save();

            $this->createStaffActivity('Account pin setup','Staff account pin was successfully set up',$user);
            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Account pin successfully set up.');

        }catch (Exception $exception){
            Log::alert($exception->getMessage());
            return $this->sendError('error',['error'=>'Internal Server error']);
        }
    }
}
