<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\EscortProfile;
use App\Models\EscortVerification;
use App\Models\GeneralSetting;
use App\Models\State;
use App\Models\User;
use App\Models\UserFeature;
use App\Notifications\CustomNotification;
use App\Notifications\SendPushNotification;
use App\Traits\Regular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            ], [], [
                'build' => 'Body Build',
                'bustSize' => 'Bust size'
            ])->stopOnFirstFailure();

            if ($validator->fails()) {
                return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);
            }

            $input = $validator->validated();

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
                    'shortBio'=>$input['shortBio']
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
                    'shortBio'=>$input['shortBio']
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

            $user->countryCode = $input['country'];
            $user->city = $input['city'];
            $user->state = $input['state'];
            $user->displayName = $input['displayName'];
            $user->phone = ltrim(ltrim(ltrim($input['phone'],'+'),$country->phonecode),0);
            $user->phoneCode = $country->phonecode;
            $user->country = $country->name;

            $user->save();

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
            'pageName'=>'Escort verification',
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
            //upload image
            $imageResult = $this->uploadGoogle($request->file('liveImage'));
            $image  = $imageResult['link'];

            $verification = EscortVerification::create([
                'user'=>$user->id,'liveVideo'=>$video,
                'photo'=>$image,'status'=>4
            ]);
            if (!empty($verification)){
                $user->isVerified=4;
                $user->save();

                //send mail to admin
                $admin = User::where('isAdmin',1)->first();
                if (!empty($admin)){
                    $message = "A new Escort verification was submitted on ".$web->name." by the escort ".$user->name.". Review immediately";
                    $admin->notify(new CustomNotification($admin,$message,'New Escort verification document received'));
                    $admin->notify(new SendPushNotification($admin,'-New Escort verification document received',$message));
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
}
