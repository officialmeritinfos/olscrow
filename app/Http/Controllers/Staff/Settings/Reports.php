<?php

namespace App\Http\Controllers\Staff\Settings;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\GeneralSetting;
use App\Models\ReportType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Reports extends BaseController
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.settings.report.index')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Report Types',
            'user'      =>$user,
            'reports'   =>ReportType::paginate(10)
        ]);
    }
}
