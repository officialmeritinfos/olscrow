<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\EscortProfile;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Hall extends Controller
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
        ]);
    }
}
