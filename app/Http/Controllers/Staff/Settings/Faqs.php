<?php

namespace App\Http\Controllers\Staff\Settings;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Faq;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Faqs extends BaseController
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.settings.faqs.index')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'FAQs',
            'user'      =>$user,
            'faqs'      =>Faq::orderBy('name','asc')->paginate(10)
        ]);
    }
}
