<?php

namespace App\Http\Controllers\Staff\Settings;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Fiat;
use App\Models\GeneralSetting;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class Packages extends BaseController
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.settings.packages.index')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'System Packages for Escort',
            'user'      =>$user,
            'packages'  =>Package::paginate(15)
        ]);
    }
    //add new package
    public function addPackage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.settings.packages.add_new')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Add Package',
            'user'      =>$user,
        ]);
    }
    //process package adding
    public function processPackageCreation(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);

            $validator = Validator::make($request->all(),[
                'name'=>['required','string','max:150','unique:packages,name'],
                'monthAmount'=>['required','numeric'],
                'annualAmount'=>['required','numeric'],
                'description'=>['required','string'],
                'fee'=>['required','numeric'],
                'isRecommended'=>['nullable','numeric'],
                'isFree'=>['nullable','numeric'],
                'hasFeatured'=>['nullable','numeric'],
                'featuredDuration'=>['nullable','string'],
                'pin'=>['required','numeric','digits:6'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error',['error'=>$validator->errors()->all()]);

            $input = $validator->validated();

            $hashed = Hash::check($input['pin'],$user->accountPin);
            if (!$hashed){
                return $this->sendError('authentication.error',['error'=>'Invalid account pin']);
            }

            $package = Package::create([
                'name'=>$input['name'],
                'description'=>$input['description'],
                'monthAmount'=>$input['monthAmount'],
                'annualAmount'=>$input['annualAmount'],
                'fee'=>$input['fee'],
                'isRecommended'=>$request->has('isRecommended')?1:2,
                'isFree'=>$request->has('isFree')?1:2,
                'hasFeatured'=>$request->has('hasFeatured')?1:2,
                'featuredDuration'=>$input['featuredDuration'],
                'status'=>1
            ]);
            if (!empty($package)){
                return $this->sendResponse([
                    'redirectTo'=>url()->previous()
                ],'Package added');
            }
            return $this->sendError('package.error',['error'=>'Something went wrong']);
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
            return $this->sendError('error',['error'=>'Internal Server error']);
        }
    }
    //edit package
    public function editPackage($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        $package = Package::where('id',$id)->firstOrFail();

        return view('staff.settings.packages.edit')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Edit Package',
            'user'      =>$user,
            'package'   =>$package
        ]);
    }
    //update
    public function updatePackage(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);

            $validator = Validator::make($request->all(),[
                'name'=>['required','string','max:150'],
                'monthAmount'=>['required','numeric'],
                'annualAmount'=>['required','numeric'],
                'description'=>['required','string'],
                'fee'=>['required','numeric'],
                'isRecommended'=>['nullable','numeric'],
                'isFree'=>['nullable','numeric'],
                'hasFeatured'=>['nullable','numeric'],
                'featuredDuration'=>['nullable','string'],
                'pin'=>['required','numeric','digits:6'],
                'status'=>['required','numeric'],
                'id'=>['required','numeric','exists:packages,id']
                ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error',['error'=>$validator->errors()->all()]);

            $input = $validator->validated();

            $hashed = Hash::check($input['pin'],$user->accountPin);
            if (!$hashed){
                return $this->sendError('authentication.error',['error'=>'Invalid account pin']);
            }

            $packageExists = Package::where('name',$input['name'])->where('id','!=',$input['id'])->first();
            if (!empty($packageExists)){
                return $this->sendError('package.error',['error'=>'A package with this name already exists']);
            }

             $update = Package::where('id',$input['id'])->update([
                'name'=>$input['name'],
                'description'=>$input['description'],
                'monthAmount'=>$input['monthAmount'],
                'annualAmount'=>$input['annualAmount'],
                'fee'=>$input['fee'],
                'isRecommended'=>$request->has('isRecommended')?1:2,
                'isFree'=>$request->has('isFree')?1:2,
                'hasFeatured'=>$request->has('hasFeatured')?1:2,
                'featuredDuration'=>$input['featuredDuration'],
                'status'=>$input['status']
            ]);
            if ($update){
                return $this->sendResponse([
                    'redirectTo'=>url()->previous()
                ],'Package updated');
            }
            return $this->sendError('package.error',['error'=>'Something went wrong']);
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
            return $this->sendError('error',['error'=>'Internal Server error']);
        }
    }
    //delete package
    public function deletePackage($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        $package = Package::where('id',$id)->firstOrFail();

        return view('staff.settings.packages.delete')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Delete Package',
            'user'      =>$user,
            'package'   =>$package
        ]);
    }
    //process package delete
    public function delete(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);

            $validator = Validator::make($request->all(),[
                'pin'=>['required','numeric','digits:6'],
                'id'=>['required','numeric','exists:packages,id']
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error',['error'=>$validator->errors()->all()]);

            $input = $validator->validated();

            $hashed = Hash::check($input['pin'],$user->accountPin);
            if (!$hashed){
                return $this->sendError('authentication.error',['error'=>'Invalid account pin']);
            }

            $packageExists = Package::where('id',$input['id'])->first();
            if (empty($packageExists)){
                return $this->sendError('package.error',['error'=>'Package does not exist']);
            }

            //check if there are users with the package activated
            $users = User::where('package',$packageExists->id)->where('renewSubscription',1)->get();
            if ($users->count()>0){
                return $this->sendError('package.error',['error'=>'There are users with active subscription on this package. Edit instead.']);
            }

            $packageExists->delete();

            return $this->sendResponse([
                'redirectTo'=>route('staff.settings.packages')
            ],'Package deleted');
        }catch (\Exception $exception){
            Log::alert($exception->getMessage());
            return $this->sendError('error',['error'=>'Internal Server error']);
        }
    }
}
