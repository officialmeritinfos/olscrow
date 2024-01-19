<?php

namespace App\Http\Controllers\Staff\Settings;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Fiat;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Countries extends BaseController
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.settings.countries')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Supported Countries',
            'user'      =>$user,
            'countries' =>Country::paginate(10)
        ]);
    }
}
