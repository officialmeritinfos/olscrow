<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\UserFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Features extends BaseController
{
    //packages
    public function packages()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.features.packages')->with([
            'web'           =>$web,
            'siteName'      =>$web->name,
            'pageName'      =>'Escort Order Packages',
            'user'          =>$user,
            'packages'      =>Order::orderBy('id','desc')->paginate(15),
        ]);
    }
    //escort body features
    public function escortBodyFeature()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.features.escort_body_feature')->with([
            'web'           =>$web,
            'siteName'      =>$web->name,
            'pageName'      =>'Escort Body Features',
            'user'          =>$user,
            'features'      =>UserFeature::orderBy('type','desc')->paginate(15),
        ]);
    }
}
