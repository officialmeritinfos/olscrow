<?php

namespace App\Http\Controllers\Staff\Settings;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Fiat;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Fiats extends BaseController
{
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.settings.fiat.index')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Supported Fiats',
            'user'      =>$user,
            'fiats'     =>Fiat::paginate(15)
        ]);
    }
}
