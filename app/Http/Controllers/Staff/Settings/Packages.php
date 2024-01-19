<?php

namespace App\Http\Controllers\Staff\Settings;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Fiat;
use App\Models\GeneralSetting;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
