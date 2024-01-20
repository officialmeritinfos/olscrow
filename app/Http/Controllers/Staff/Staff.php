<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\StaffRole;
use App\Models\User;
use App\Notifications\EmailVerification;
use App\Notifications\WelcomeMailToStaff;
use App\Traits\Regular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class Staff extends BaseController
{
    use Regular;
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.staff.index')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Staff Lists',
            'user'      =>$user,
            'staffs'    =>User::where('isStaff',1)->paginate(15)
        ]);
    }
    //new staff
    public function createStaff()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();


        return view('staff.staff.add_new')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Add Staff',
            'user'      =>$user,
            'roles'     =>StaffRole::where('status',1)->get()
        ]);
    }
    //process Staff Creation
    public function processStaffAddition(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);

            $validator = Validator::make($request->all(),[
                'name'=>['required','string','max:150'],
                'email'=>['required','email','max:150','unique:users,email'],
                'username'=>['required','string','max:150','unique:users,username'],
                'password' => ['required', Password::min(8)->uncompromised(1)],
                'pin'=>['required','numeric','digits:6'],
                'role'=>['required','numeric','exists:staff_roles,id']
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error',['error'=>$validator->errors()->all()]);

            $input = $validator->validated();

            $hashed = Hash::check($input['pin'],$user->accountPin);
            if (!$hashed){
                return $this->sendError('authentication.error',['error'=>'Invalid account pin']);
            }

            $reference = $this->generateUniqueId('users','reference');

            $role = StaffRole::where('id',$input['role'])->first();

            $staff = User::create([
                'name'=>$input['name'],'email'=>$input['email'],'username'=>$input['username'],
                'reference'=>$reference,'isStaff'=>1,'role'=>$input['role'],
                'isAdmin'=>$role->isAdmin,'registrationIp'=>$request->ip(),
                'password' => bcrypt($input['password']),'emailVerified'=>$web->emailVerification,
                'email_verified_at'=>($web->emailVerification==1)?$this->getCurrentDateTimeString():''
            ]);

            if (!empty($staff)){
                $this->initializeUserSettings($staff);
                $this->createStaffActivity('Staff Addition','A new staff was added by '.$user->name,$user);
                $staff->notify(new WelcomeMailToStaff($staff,$input['password']));
                return $this->sendResponse([
                    'redirectTo'=>route('staff.staff.detail',['id'=>$staff->reference])
                ],'Staff added successfully.');
            }
            return $this->sendError('staff.error',['error'=>'Something went wrong']);
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
            return $this->sendError('error',['error'=>'Internal Server error']);
        }
    }
    //edit staff
    public function staffDetail($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $staff = User::where(['reference'=>$id,'isStaff'=>1])->firstOrFail();

        return view('staff.staff.detail')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Staff Detail',
            'user'      =>$user,
            'staff'     =>$staff,
            'roles'     =>StaffRole::where('status',1)->get()
        ]);
    }
    //process staff Update
    public function processStaffUpdate(Request $request)
    {

    }
}
