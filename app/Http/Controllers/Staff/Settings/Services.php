<?php

namespace App\Http\Controllers\Staff\Settings;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\GeneralSetting;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Services extends BaseController
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.settings.services.index')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Escort Services',
            'user'      =>$user,
            'services'  =>Service::paginate(10)
        ]);
    }
}
