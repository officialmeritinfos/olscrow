<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Home extends BaseController
{
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
    public function setPin()
    {

    }
}
