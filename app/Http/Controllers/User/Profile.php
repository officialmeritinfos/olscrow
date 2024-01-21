<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\EscortPhoto;
use App\Models\EscortProfile;
use App\Models\EscortSubscriptionPayment;
use App\Models\EscortVerification;
use App\Models\Fiat;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Package;
use App\Models\Service;
use App\Models\State;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserAddonEnrollment;
use App\Models\UserBank;
use App\Models\UserFeature;
use App\Models\UserSetting;
use App\Models\UserVerification;
use App\Notifications\CustomNotification;
use App\Notifications\SendPushNotification;
use App\Traits\Flutterwave;
use App\Traits\Regular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;

class Profile extends BaseController
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

        return view('dashboard.pages.profile.profile')->with([
            'web'=>$web,
            'pageName'=>$type.' Profile',
            'type'=>$type,
            'siteName'=>$web->name,
            'user'=>$user
        ]);
    }
    //public profile
    public function publicProfile()
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        return view('dashboard.pages.profile.publicProfile')->with([
            'web'=>$web,
            'pageName'=>'Public Profile Setup',
            'siteName'=>$web->name,
            'user'=>$user,
            'profile'=>EscortProfile::where('user',$user->id)->first(),
            'busts'=>UserFeature::where([
                'type'=>'bust','status'=>1
            ])->get(),
            'looks'=>UserFeature::where([
                'type'=>'looks','status'=>1
            ])->get(),
            'builds'=>UserFeature::where([
                'type'=>'build','status'=>1
            ])->get(),
            'ethnics'=>UserFeature::where([
                'type'=>'ethnicities','status'=>1
            ])->get(),
            'weights'=>UserFeature::where([
                'type'=>'weight','status'=>1
            ])->get(),
            'heights'=>UserFeature::where([
                'type'=>'height','status'=>1
            ])->get(),
            'services'=>Service::where([
                'status'=>1
            ])->orderBy('name','asc')->get()
        ]);

    }
    //set public profile
    public function setPublicProfile(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'education' => ['required', 'string'],
                'occupation' => ['required', 'string'],
                'shortBio' => ['required', 'string'],
                'about' => ['required', 'string'],
                'build' => ['required', 'numeric',Rule::exists('user_features','id')->where('type','build')],
                'bustSize' => ['required', 'numeric',Rule::exists('user_features','id')->where('type','bust')],
                'ethnicity' => ['required', 'numeric',Rule::exists('user_features','id')->where('type','ethnicities')],
                'height' => ['required', 'numeric',Rule::exists('user_features','id')->where('type','height')],
                'weight' => ['required', 'numeric',Rule::exists('user_features','id')->where('type','weight')],
                'look' => ['required', 'numeric',Rule::exists('user_features','id')->where('type','looks')],
                'sexualOrientation' => ['required', 'string'],
                'languages'=>['required'],
                'languages.*'=>['required','string'],
                'incall'=>['required','numeric','integer'],
                'outcall'=>['required','numeric','integer'],
                'smoker'=>['required','numeric','integer'],
                'service'=>['required'],
                'service.*'=>['required','numeric','exists:services,id']
            ], [], [
                'build' => 'Body Build',
                'bustSize' => 'Bust size'
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }

            $input = $validator->validated();
            $services = implode(',',$input['service']);

            //profile exists
            $profileExists = EscortProfile::where('user',$user->id)->first();
            if (empty($profileExists)){
                $profile = EscortProfile::create([
                    'user'=>$user->id,
                    'education'=>$input['education'],'occupation'=>$input['occupation'],
                    'about'=>$input['about'],'ethnicity'=>$input['ethnicity'],
                    'bustSize'=>$input['bustSize'],'height'=>$input['height'],
                    'weight'=>$input['weight'],'build'=>$input['build'],
                    'looks'=>$input['look'],'smoker'=>$input['smoker'],
                    'sexualOrientation'=>$input['sexualOrientation'],
                    'incall'=>$input['incall'],'outcall'=>$input['outcall'],
                    'languages'=>implode(',',$input['languages']),
                    'shortBio'=>$input['shortBio'],
                    'services'=>$services
                ]);
                if (!empty($profile)){

                    return $this->sendResponse([
                        'redirectTo'=>url()->previous()
                    ],'Profile successfully created');

                }else{
                    return $this->sendError('public.profile.error',['error'=>'Something went wrong while processing your request']);
                }
            }else{
                $update = EscortProfile::where('id',$profileExists->id)->update([
                    'education'=>$input['education'],'occupation'=>$input['occupation'],
                    'about'=>$input['about'],'ethnicity'=>$input['ethnicity'],
                    'bustSize'=>$input['bustSize'],'height'=>$input['height'],
                    'weight'=>$input['weight'],'build'=>$input['build'],
                    'looks'=>$input['look'],'smoker'=>$input['smoker'],
                    'sexualOrientation'=>$input['sexualOrientation'],
                    'incall'=>$input['incall'],'outcall'=>$input['outcall'],
                    'languages'=>implode(',',$input['languages']),
                    'shortBio'=>$input['shortBio'],
                    'services'=>$services
                ]);
                if ($update){
                    return $this->sendResponse([
                        'redirectTo'=>url()->previous()
                    ],'Profile successfully updated');
                }else{
                    return $this->sendError('public.profile.error',['error'=>'Something went wrong while updating profile']);
                }
            }
        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('public.profile.error',['error'=>'Internal Server error']);
        }
    }
    //profile location
    public function profileLocation()
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        return view('dashboard.pages.profile.location')->with([
            'web'=>$web,
            'pageName'=>'Profile Location Setup',
            'siteName'=>$web->name,
            'user'=>$user,
            'countries'=>Country::where('status',1)->get()
        ]);
    }
    //process location update
    public function processLocationUpdate(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'country' => ['required', 'alpha',Rule::exists('countries','iso3')],
                'state' => ['required', 'numeric',Rule::exists('states','id')],
                'city' => ['required', 'numeric',Rule::exists('cities','id')],
                'displayName'=>['required','string'],
                'phone'=>['required','string'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $country = Country::where('iso3',$input['country'])->first();
            if (empty($country)){
                return $this->sendError('country.error',['error'=>'Country not found.']);
            }
            $state = State::where([
                'country_id'=>$country->id,
                'id'=>$input['state']
            ])->first();
            if (empty($state)){
                return $this->sendError('state.error',['error'=>'State/Region not found.']);
            }
            $city = City::where([
                'state_id'=>$state->id,
                'country_id'=>$country->id,
                'id'=>$input['city']
            ])->first();
            if (empty($city)){
                return $this->sendError('state.error',['error'=>'City not found.']);
            }

            //check that user has updated profile
            $hasUpdatedProfile = EscortProfile::where('user',$user->id)->first();

            if ($user->accountType==1 && empty($hasUpdatedProfile)){
                return $this->sendError('profile.error',['error'=>'Please update your public profile first']);
            }

            $user->countryCode = $input['country'];
            $user->city = $input['city'];
            $user->state = $input['state'];
            $user->displayName = $input['displayName'];
            $user->phone = ltrim(ltrim(ltrim($input['phone'],'+'),$country->phonecode),0);
            $user->phoneCode = $country->phonecode;
            $user->country = $country->name;

            $user->save();

            UserActivity::create([
                'user'=>$user->id,'title'=>'Location updated',
                'content'=>'Account Location was updated from account via IP: '.$request->ip()
            ]);

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Location updated successfully.');

        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('location.error',['error'=>'Internal Server error']);
        }
    }
    //fetch the states under a country
    public function fetchCountryStates(Request $request)
    {
        if (!$request->has('country')){
            return $this->sendError('country.error',['error'=>'Country Id is needed']);
        }
        $countryId = $request->get('country');

        $country = Country::where('iso3',$countryId)->first();
        if (empty($country)){
            return $this->sendError('country.error',['error'=>'Unknown country']);
        }
        $states = State::where('country_id',$country->id)->orderBy('name','asc')->get();
        $stateData =[];
        foreach ($states as $state) {
            $dataState = [
                'id'=>$state->id,
                'name'=>$state->name,
            ];

            $stateData[]=$dataState;
        }

        return $this->sendResponse([
           'states'=> $stateData
        ],'retrieved');
    }
    //fetch the cities under a state
    public function fetchStateCity(Request $request)
    {
        if (!$request->has('state')){
            return $this->sendError('state.error',['error'=>'State Id is needed']);
        }
        $stateId = $request->get('state');

        $state = State::where('id',$stateId)->first();
        if (empty($state)){
            return $this->sendError('state.error',['error'=>'Unknown state']);
        }
        $cities = City::where('state_id',$state->id)->orderBy('name','asc')->get();
        $stateData =[];
        foreach ($cities as $city) {
            $dataState = [
                'id'=>$city->id,
                'name'=>$city->name,
            ];

            $stateData[]=$dataState;
        }

        return $this->sendResponse([
            'cities'=> $stateData
        ],'retrieved');
    }
    //escort verification
    public function escortVerification()
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        return view('dashboard.pages.profile.verification')->with([
            'web'=>$web,
            'pageName'=>'Profile verification',
            'siteName'=>$web->name,
            'user'=>$user,
            'countries'=>Country::where('status',1)->get()
        ]);
    }
    //upload verification
    public function processEscortVerification(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'liveVideo' => ['required', 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,video/3gpp,video/x-msvideo,video/webm','max:20840'],
                'liveImage' => ['required', 'image','max:1024'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            //upload the video
            $videoResult = $this->uploadGoogle($request->file('liveVideo'));
            $video  = $videoResult['link'];
            //upload image - we will watermark this image
            $imageResult = $this->uploadGoogle($request->file('liveImage'));
            $image  = $imageResult['link'];

            if ($user->accountType==1 && empty($user->city)){
                return $this->sendError('profile.error',['error'=>'Please update your public location first']);
            }

            $verification = EscortVerification::create([
                'user'=>$user->id,'liveVideo'=>$video,
                'photo'=>$image,'status'=>4
            ]);
            if (!empty($verification)){
                $user->isVerified=4;
                $user->save();
                UserActivity::create([
                    'user'=>$user->id,'title'=>'KYC Submitted',
                    'content'=>'Account KYC was submitted from account via IP: '.$request->ip()
                ]);
                //send mail to admin
                $admin = User::where('isAdmin',1)->first();
                if (!empty($admin)){
                    $message = "A new Escort verification was submitted on ".$web->name." by the escort ".$user->name.". Review immediately";
                    $admin->notify(new CustomNotification($admin,$message,'New Escort verification document received'));
                    $admin->notify(new SendPushNotification($admin,'New Escort verification document received',$message));
                }
                return $this->sendResponse([
                    'redirectTo'=>url()->previous()
                ],'Verification document submitted.');
            }else{
                return $this->sendError('verification.error',['error'=>'Something went wrong']);
            }
        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('location.error',['error'=>'Internal Server error']);
        }
    }
    public function processUserVerification(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'liveVideo' => ['required', 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,video/3gpp,video/x-msvideo,video/webm','max:20840'],
                'liveImage' => ['required', 'image','max:1024'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            //upload the video
            $videoResult = $this->uploadGoogle($request->file('liveVideo'));
            $video  = $videoResult['link'];
            //upload image - we will watermark this image
            $imageResult = $this->uploadGoogle($request->file('liveImage'));
            $image  = $imageResult['link'];

            $verification = UserVerification::create([
                'user'=>$user->id,'liveVideo'=>$video,
                'photo'=>$image,'status'=>4
            ]);
            if (!empty($verification)){
                $user->isVerified=4;
                $user->save();
                UserActivity::create([
                    'user'=>$user->id,'title'=>'KYC Submitted',
                    'content'=>'Account KYC was submitted from account via IP: '.$request->ip()
                ]);
                //send mail to admin
                $admin = User::where('isAdmin',1)->first();
                if (!empty($admin)){
                    $message = "A new User verification was submitted on ".$web->name." by the escort ".$user->name.". Review immediately";
                    $admin->notify(new CustomNotification($admin,$message,'New User verification document received'));
                    $admin->notify(new SendPushNotification($admin,'New User verification document received',$message));
                }
                return $this->sendResponse([
                    'redirectTo'=>url()->previous()
                ],'Verification document submitted.');
            }else{
                return $this->sendError('verification.error',['error'=>'Something went wrong']);
            }
        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('location.error',['error'=>'Internal Server error']);
        }
    }
    //security setting
    public function securitySetting()
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        return view('dashboard.pages.profile.security')->with([
            'web'=>$web,
            'pageName'=>'Account Security',
            'siteName'=>$web->name,
            'user'=>$user,
            'countries'=>Country::where('status',1)->get(),
            'setting'=>UserSetting::where('user',$user->id)->first()
        ]);
    }
    //change password
    public function changePassword(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'oldPassword'=>['required','string','current_password:web'],
                'password'=>['required',Password::min(8)->uncompromised(1),'confirmed'],
                'password_confirmation'=>['required','same:password']
            ],['current_password'=>'Current password is wrong'],['oldPassword'=>'Current Password'])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $user->password = bcrypt($input['password']);
            $user->save();
            UserActivity::create([
                'user'=>$user->id,'title'=>'Password Reset',
                'content'=>'Account password was reset from account via IP: '.$request->ip()
            ]);
            $message = "Your ".$web->name." account password was recently reset from your account. Please contact support if you did not make this change.";
            //send notification
            $user->notify(new CustomNotification($user,$message,'Account Password Reset Notification'));
            $user->notify(new SendPushNotification($user,'Account Password Reset Notification',$message));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Password successfully reset');

        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('location.error',['error'=>'Internal Server error']);
        }
    }
    //two factor authentication
    public function twoFactorAuth(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'password'=>['required','string','current_password:web',Password::min(8)->uncompromised(1)],
                'twoFactor'=>['required','numeric'],
            ],['current_password'=>'Current password is wrong'],['oldPassword'=>'Current Password'])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            $setting = UserSetting::where('user',$user->id)->first();

            $setting->twoFactor = $input['twoFactor'];
            $setting->save();
            UserActivity::create([
                'user'=>$user->id,'title'=>'Two Factor Authentication Updated',
                'content'=>'Two-factor authentication was updated from account via IP: '.$request->ip()
            ]);
            $message = "Your ".$web->name." account two-factor authentication was recently updated from your account. Please contact support if you did not make this change.";
            //send notification
            $user->notify(new CustomNotification($user,$message,'Security update'));
            $user->notify(new SendPushNotification($user,'Security Update',$message));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Two-factor authentication successfully updated');

        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('location.error',['error'=>'Internal Server error']);
        }
    }
    //user gallery
    public function gallery()
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        return view('dashboard.pages.profile.gallery')->with([
            'web'=>$web,
            'pageName'=>'Gallery',
            'siteName'=>$web->name,
            'user'=>$user,
            'photos'=>EscortPhoto::where('user',$user->id)->paginate()
        ]);
    }
    //process gallery upload
    public function processGalleryUpload(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'photos'=>['required','array','max:5'],
                'photos.*'=>['required','image']
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            foreach($request->file('photos') as $key => $file)
            {
                $result = $this->uploadGoogle($file);
                $fileName = $result['link'];

                EscortPhoto::create([
                    'user'=>$user->id,
                    'photo'=>$fileName,
                    'reference'=>$this->generateUniqueReference('escort_photos','reference',10)
                ]);
            }
            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Photos successfully uploaded.');

        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('gallery.upload.error',['error'=>'Internal Server error']);
        }
    }
    //ste image as profile image
    public function setPhotoAsProfile($id)
    {
        $user = Auth::user();

        $photo = EscortPhoto::where([
            'user'=>$user->id,'reference'=>$id
        ])->firstOrFail();

        //check the image that was there
        if ($user->photo ==$photo->photo){
            return back()->with('error','This is image is already set as the profile image');
        }
        //check the image with the current image
        $currentPhoto = EscortPhoto::where('photo',$user->photo)->first();


        $user->photo = $photo->photo;
        $user->save();
        $photo->isProfile=1;
        $photo->save();

        if (!empty($currentPhoto)){
            $currentPhoto->isProfile = 2;
            $currentPhoto->save();
        }

        return back()->with('success','Image set as profile image');
    }
    //delete image
    public function deleteAnImage($id)
    {
        $user = Auth::user();

        $photo = EscortPhoto::where([
            'user'=>$user->id,'reference'=>$id
        ])->firstOrFail();

        //check the image that was there
        if ($user->photo ==$photo->photo){
            return back()->with('error','This is image is already set as the profile image. Set another image first before you can delete.');
        }

        $this->deleteUpload($user->photo);

        $photo->delete();

        return  back()->with('success','Image removed');

    }
    //subscription
    public function subscriptionManagement()
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        return view('dashboard.pages.profile.subscription')->with([
            'web'=>$web,
            'pageName'=>'Subscription',
            'siteName'=>$web->name,
            'user'=>$user,
            'packages'=>Package::where('status',1)->get(),
            'fiat'=>Fiat::where('code',$user->mainCurrency)->first(),
            'payments'=>EscortSubscriptionPayment::where('user',$user->id)->paginate()
        ]);
    }
    //enroll in subscription
    public function processSubscriptionEnrollment(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'package' => ['required', 'exists:packages,id'],
                'paymentMethod' => ['required'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();

            //check that user has completed KYC
            if ($user->isVerified!=1){
                return $this->sendError('account.error',['error'=>'Your account has not been verified or it is under review.']);
            }

            $package = Package::where('id',$input['package'])->first();

            //check that user has updated profile
            $hasUpdatedProfile = EscortProfile::where('user',$user->id)->first();

            if ($user->accountType==1 && empty($hasUpdatedProfile)){
                return $this->sendError('profile.error',['error'=>'Please update your public profile first']);
            }

            //check that user has updated location
            if ($user->accountType==1 && empty($user->city)){
                return $this->sendError('profile.error',['error'=>'Please update your public location first']);
            }

            //check if user has set orders
            $hasOrders = Order::where('user',$user->id)->where('status',1)->get();
            if ($hasOrders->count()<1){
                return $this->sendError('profile.error',['error'=>'Please set your packages first before activating account']);
            }


            if ($user->isVerified!=1){
                return $this->sendError('kyc.error',['error'=>'Please verify your account first']);
            }

            $fiat = Fiat::where('code',$user->mainCurrency)->first();
            $balance = $user->subscriptionBalance;

            switch ($input['paymentMethod']){
                case 1:
                    $amountToCharge = $package->monthAmount*$fiat->rate;
                    $user->subscriptionBalance = $user->subscriptionBalance - $amountToCharge;
                    $user->package=$package->id;
                    $user->fetaured = $package->hasFeatured;
                    if ($package->hasFeatured==1){
                        $user->featuredEnd =strtotime($package->featuredDuration,time());
                    }
                    $user->fee = $package->fee;
                    if (empty($user->subRenewalDate)){
                        $user->subRenewalDate=strtotime('1 Month',time());
                    }elseif($user->subRenewalDate < time()){
                        $user->subRenewalDate=strtotime('1 Month',$user->subRenewalDate);
                    }else{
                        $user->subRenewalDate=strtotime('1 Month',$user->subRenewalDate);
                    }
                    break;
                default:
                    $amountToCharge = $package->annualAmount*$fiat->rate;
                    $user->subscriptionBalance = $user->subscriptionBalance - $amountToCharge;
                    $user->package=$package->id;
                    $user->fetaured = $package->hasFeatured;
                    if ($package->hasFeatured==1){
                        $user->featuredEnd =strtotime($package->featuredDuration,time());
                    }
                    $user->fee = $package->fee;
                    if (empty($user->subRenewalDate)){
                        $user->subRenewalDate=strtotime('1 Year',time());
                    }elseif($user->subRenewalDate < time()){
                        $user->subRenewalDate=strtotime('1 Year',$user->subRenewalDate);
                    }else{
                        $user->subRenewalDate=strtotime('1 Year',$user->subRenewalDate);
                    }
                    break;
            }
            //check balance
            if ($balance<$amountToCharge){
                return $this->sendError('balance.error',['error'=>'Insufficient balance in Subscription balance.']);
            }
            $subscription = EscortSubscriptionPayment::create([
                'user'=>$user->id,'reference'=>$this->generateUniqueReference('escort_subscription_payments','reference',20),
                'amount'=>$amountToCharge,'currency'=>$user->mainCurrency,'balanceAfter'=>$balance-$amountToCharge,'package'=>$package->id
            ]);
            if (!empty($subscription)){
                $user->enrollmentType=$input['paymentMethod'];
                $user->isPublic=1;
                $user->renewSubscription=1;
                $message = 'Your subscription to '.$package->name.' was successful and account now public..';
                $user->isEnrolled=1;
                $user->save();

                UserActivity::create([
                    'user'=>$user->id,
                    'title'=>'Subscription enrollment',
                    'content'=>$message
                ]);

                $user->notify(new CustomNotification($user,$message,'Subscription Enrollment'));
                $user->notify(new SendPushNotification($user,'Subscription Enrollment',$message));

                return $this->sendResponse([
                    'redirectTo'=>url()->previous()
                ],'Subscription enrollment successful.');
            }
            return $this->sendError('subscription.error',['error'=>'Something went wrong while processing request. Please try again or contact support. ']);
        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('subscription.enrollment.error',['error'=>'Internal Server error']);
        }
    }
    //cancel subscription
    public function cancelSubscription(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'current_password:web'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }

            $package = Package::where('id',$user->package)->first();
            //check that user is enrolled
            if ($user->renewSubscription!=1){
                return $this->sendError('subscription.error', ['error' => 'Subscription renewal already cancelled']);
            }

            if ($package->isFree==1){
                return $this->sendError('subscription.error', ['error' => 'You cannot cancel your subscription to the free package.']);
            }

            $user->renewSubscription=2;
            $user->save();

            $message = "Your subscription to ".$package->name." on ".$web->name." has been cancelled. Your subscription will not renew";

            UserActivity::create([
                'user'=>$user->id,
                'title'=>'Subscription cancellation',
                'content'=>$message
            ]);

            $user->notify(new SendPushNotification($user,'Subscription Cancellation',$message));


            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Subscription cancelled. We are sorry to see you go.');

        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('subscription.cancellation.error',['error'=>'Internal Server error']);
        }
    }
    //reactivate subscription
    public function reactivateSubscription(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'current_password:web'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }

            //check that user is enrolled
            if ($user->renewSubscription==1){
                return $this->sendError('subscription.error', ['error' => 'Subscription renewal is already active']);
            }

            if (time() >$user->subRenewalDate){
                return $this->sendError('subscription.error', ['error' => 'Subscription date already elapsed. Please contact support.']);
            }

            $package = Package::where('id',$user->package)->first();

            $user->renewSubscription=1;
            $user->save();

            $message = "Your subscription to ".$package->name." on ".$web->name." has been reactivated. Your subscription will now renew at the end of its cycle.";

            UserActivity::create([
                'user'=>$user->id,
                'title'=>'Subscription reactivation',
                'content'=>$message
            ]);

            $user->notify(new SendPushNotification($user,'Subscription Reactivation',$message));

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Welcome back. Your subscription will renew at towards the end of its cycle.');

        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('subscription.reactivation.error',['error'=>'Internal Server error']);
        }
    }
    //profile addons
    public function profileAddon()
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        return view('dashboard.pages.profile.addons')->with([
            'web'=>$web,
            'pageName'=>'Addons',
            'siteName'=>$web->name,
            'user'=>$user,
            'fiat'=>Fiat::where('code',$user->mainCurrency)->first(),
        ]);
    }
    //get an account on featured
    public function enrollInFeatured(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'current_password:web'],
                'period' => ['required', 'numeric','integer'],
                'interval' => ['required', 'numeric','integer'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }

            $input = $validator->validated();
            $fiat = Fiat::where('code',$user->mainCurrency)->first();

            if ($user->fetaured==4){
                return $this->sendError('addon.enrollment.error',['error'=>'You have an enrollment awaiting review']);
            }

            if ($user->fetaured==1){
                return $this->sendError('addon.enrollment.error',['error'=>'You already have an active enrollment.']);
            }
            switch ($input['period']){
                case 1:
                    $duration = $input['interval'].' Months';
                    $fee = $web->featuredFee*$input['interval']*$fiat->rate;
                    break;
                default:
                    $duration = $input['interval'].' Years';
                    $fee = $web->featuredFee*$input['interval']*$fiat->rate*10;
                    break;
            }

            if ($fee>$user->subscriptionBalance){
                return $this->sendError('balance.error',['error'=>'Insufficient balance to cover for '.$fiat->sign.number_format($fee)]);
            }

            $user->subscriptionBalance = $user->subscriptionBalance - $fee;

            $enrollment = UserAddonEnrollment::create([
                'user'=>$user->id,'reference'=>$this->generateUniqueReference('user_addon_enrollments','reference',20),
                'amount'=>$fee,'duration'=>$duration,'type'=>'Premium Account Featuring','status'=>4
            ]);
            if (!empty($enrollment)){

                $user->fetaured=4;
                $user->hasAddon=4;
                $user->save();

                UserActivity::create([
                    'user'=>$user->id,'title'=>'Addon Enrollment',
                    'content'=>'Your account was debited of '.$fiat->sign.number_format($fee,2).' for purchase of an addon - Premium account Featuring for a duration of '.$duration
                ]);
                $message = "Your purchase of an addon - Premium Account Featuring has been received, and will be activated for your account. The sum of ".$fiat->sign.number_format($fee,2)." was paid for this, for a duration of ".$duration;
                $user->notify(new SendPushNotification($user,'New Addon purchase - Premium Account Featuring',$message,route('user.addons')));

                $admin = User::where('isAdmin',1)->first();
                if (!empty($admin)){
                    $adminMessage = "A new addon purchase with reference ".$enrollment->reference." has been received from ".$user->name.". Please review and activate";
                    $admin->notify(new SendPushNotification($admin,'New Addon purchase',$adminMessage));
                }
                return $this->sendResponse([
                    'redirectTo'=>url()->previous()
                ],'Purchase was successful. Your account will be reviewed and addon activated for you.');
            }
            return $this->sendError('addon.enrollment.error',['error'=>'Something went wrong']);
        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('addon.featured.enrollment.error',['error'=>'Internal Server error']);
        }
    }

    //user referral
    public function referrals()
    {
        $user = Auth::user();
        if ($user->accountType==1){
            $type ='Escort';
        }else{
            $type = 'User';
        }
        $web = GeneralSetting::find(1);

        return view('dashboard.pages.profile.referrals')->with([
            'web'=>$web,
            'pageName'=>'Referral Programme',
            'type'=>$type,
            'siteName'=>$web->name,
            'user'=>$user,
            'referrals'=>User::where('referral',$user->id)->paginate(10)
        ]);
    }
    //payout account
    public function payoutAccounts()
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        return view('dashboard.pages.profile.payout_accounts')->with([
            'web'=>$web,
            'pageName'=>'Payout Accounts',
            'siteName'=>$web->name,
            'user'=>$user,
            'referrals'=>User::where('referral',$user->id)->paginate(10)
        ]);
    }
    //add a beneficiary account
    public function addPayoutAccount(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'password'=>['required','string','current_password:web',Password::min(8)->uncompromised(1)],
                'otp'=>['required','numeric'],
                'bank'=>['required','numeric'],
                'accountNumber'=>['required','numeric'],
                'isPrimary'=>['nullable','numeric'],
            ],['current_password'=>'Current password is wrong'],['oldPassword'=>'Current Password'])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }
            $input = $validator->validated();
            //check the otp.
            if ($user->otpExpires<time()){
                return $this->sendError('authentication.error', ['error' => 'OTP has timed out.']);
            }

            if (!Hash::check($input['otp'],$user->otp)){
                return $this->sendError('authentication.error', ['error' => 'Invalid OTP']);
            }
            $user->otp='';
            $user->otpExpires='';
            $user->save();

            //check if account already exists
            $exists = UserBank::where([
                'bank'=>$input['bank'],
                'accountNumber'=>$input['accountNumber'],
                'user'=>$user->id
            ])->first();

            if (!empty($exists)){
                return $this->sendError('payout.account.error',['error'=>'Payout account already exist']);
            }

            $reference = $this->generateUniqueReference('user_banks','reference',20);
            //create the beneficiary
            $client = new Flutterwave();
            $response = $client->addBeneficiary([
               'account_bank'=>$input['bank'],
                'account_number'=>$input['accountNumber'],
                'beneficiary_name'=>$user->name
            ]);

            if ($response->ok()){
                $res = $response->json();
                $data = $res['data'];

                $bankName = $data['bank_name'];
                $benId = $data['id'];
                $accountName = $data['full_name'];
            }else{
                Log::info($response->json());
                return $this->sendError('payout.account.error',['error'=>'Something went wrong registering beneficiary']);
            }

            $beneficiary = UserBank::create([
                'user'=>$user->id,'bank'=>$input['bank'],
                'bankName'=>$bankName,'accountNumber'=>$input['accountNumber'],
                'reference'=>$reference,'benRef'=>$benId,
                'accountName'=>$accountName
            ]);

            if (!empty($beneficiary)){


                $message = 'A new payout account has been added to your account on '.$web->name;
                UserActivity::create([
                    'user'=>$user->id,'title'=>'New Payout account',
                    'content'=>$message
                ]);
                //send notification
                $user->notify(new SendPushNotification($user,'New Payout Account',$message));
                return $this->sendResponse([
                    'redirectTo'=>url()->previous()
                ],'Beneficiary account successfully added.');
            }
            return $this->sendError('payout.account.error',['error'=>'We are unable to add beneficiary.']);

        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('location.error',['error'=>'Internal Server error']);
        }
    }

}
