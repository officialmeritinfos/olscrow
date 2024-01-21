<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\EscortPhoto;
use App\Models\EscortProfile;
use App\Models\EscortReview;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\User;
use App\Models\UserBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Hall extends BaseController
{
    //landing page
    public function landingPage()
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        $sliderFreshEscorts = User::where([
            'accountType'=>1,'isPublic'=>1,'fetaured'=>1
        ])->where('gender','!=',$user->gender)->where('id','!=',$user->id)
            ->orderBy('isLoggedIn','asc')->orderBy('lastLogin','desc')->limit(40)->get();

        $freshEscorts  = User::where([
            'accountType'=>1,'isPublic'=>1,'fetaured'=>1
        ])->where('gender','!=',$user->gender)->where('id','!=',$user->id)->limit(30)
            ->orderBy('isLoggedIn','asc')->orderBy('lastLogin','desc')->get();

        $escorts = User::where([
            'accountType'=>1,'isPublic'=>1
        ])->where('gender','!=',$user->gender)->where('fetaured','!=',1)
            ->where('id','!=',$user->id)->limit(30)->orderBy('isLoggedIn','asc')
            ->orderBy('created_at','desc')->get();

        if ($user->accountType!=1 && $user->isVerified!=1){
            return back()->with('error','Please verify your account before you can proceed to escort hall');
        }

        if ($user->accountType==1 && $user->isStaff!=1){
            return back()->with('error','Please create a client account to view Escort Hall. You cannot view escort hall as an escort.');
        }

        //return the view
        return view('dashboard.pages.hall.index')->with([
            'web'=>$web,
            'pageName'=>'Hall Way',
            'siteName'=>$web->name,
            'user'=>$user,
            'slideEscorts'=>$sliderFreshEscorts,
            'proEscorts'=>$freshEscorts,
            'escorts'=>$escorts
        ]);
    }
    //view specific escort
    public function escortDetail($username)
    {
        $user = Auth::user();
        $web = GeneralSetting::find(1);

        $escort = User::where([
            'accountType'=>1,'isPublic'=>1,
            'username'=>$username
        ])->where('gender','!=',$user->gender)->where('id','!=',$user->id)->first();
        if (empty($escort)){
            return back()->with('error','Escort profile not found');
        }
        //return the view
        return view('dashboard.pages.hall.escort_detail')->with([
            'web'=>$web,
            'pageName'=>ucfirst($escort->username).' Profile',
            'siteName'=>$web->name,
            'user'=>$user,
            'escort'=>$escort,
            'profile'=>EscortProfile::where('user',$escort->id)->first(),
            'packages'=>Order::where([
                'user'=>$escort->id,
                'status'=>1
            ])->where('personalized','!=',1)->get(),
            'photos'=>EscortPhoto::where('user',$escort->id)->paginate(15),
            'reviews'=>EscortReview::where('user',$escort->id)->paginate(15)
        ]);
    }
    //post a review of escort
    public function reviewEscort(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'escort' => ['required', 'string',Rule::exists('users','reference')->where('accountType',1)],
                'content' => ['required', 'string'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);

            $input = $validator->validated();
            //check if there is a booking between the two
            $escort = User::where([
                'reference'=>$input['escort'],'accountType'=>1
            ])->first();

            if (empty($escort)){
                return $this->sendError('escort.profile.error',['error'=>'Escort not found']);
            }
            if ($escort->id == $user->id){
                return $this->sendError('escort.profile.error',['error'=>'You cannot write a review for yourself']);
            }
            $hasBooking = UserBooking::where([
                'user'=>$user->id,'escortId'=>$escort->id,'status'=>1
            ])->get();
            if ($hasBooking->count()<1){
                return $this->sendError('review.error',['error'=>'You have not concluded a booking with escort and therefore cannot write a review of service']);
            }

            EscortReview::create([
                'reviewer'=>$user->id,'user'=>$escort->id,'content'=>$input['content']
            ]);

            return $this->sendResponse([
                'redirectTo'=>url()->previous()
            ],'Review sent.');

        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
            return $this->sendError('review.error',['error'=>'Internal Server error']);
        }
    }
}
