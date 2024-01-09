<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\GeneralSetting;
use App\Models\Package;
use Illuminate\Http\Request;

class Home extends BaseController
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);

        return view('home.home')->with([
           'web'=>$web,
           'siteName'=>$web->name,
           'pageName'=>'Landing Page'
        ]);
    }
    //about page
    public function about()
    {
        $web = GeneralSetting::find(1);

        return view('home.about')->with([
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'About Us'
        ]);
    }
    //faq page
    public function faq()
    {
        $web = GeneralSetting::find(1);

        return view('home.faqs')->with([
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'Frequently Asked Questions',
            'faqs'=>Faq::where('status',1)->get()
        ]);
    }
    //pricing page
    public function pricing()
    {
        $web = GeneralSetting::find(1);

        return view('home.pricing')->with([
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'Pricing Plans',
            'packages'=>Package::where('status',1)->get()
        ]);
    }
    //how it works page
    public function howItWorks()
    {
        $web = GeneralSetting::find(1);

        return view('home.how_it_works')->with([
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'How '.$web->name.' works'
        ]);
    }
    //contact page
    public function contact()
    {
        $web = GeneralSetting::find(1);

        return view('home.contact')->with([
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'Contact Us'
        ]);
    }
    //escort term page
    public function escortTerm()
    {
        $web = GeneralSetting::find(1);

        return view('home.escort_term')->with([
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'Escort Terms & Conditions'
        ]);
    }
    //client terms page
    public function clientTerms()
    {
        $web = GeneralSetting::find(1);

        return view('home.client_terms')->with([
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'Client Terms & Conditions'
        ]);
    }
    //privacy policy page
    public function privacyPolicy()
    {
        $web = GeneralSetting::find(1);

        return view('home.privacy_policy')->with([
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'Privacy Policy'
        ]);
    }
    //report page
    public function reportTypes()
    {
        $web = GeneralSetting::find(1);

        return view('home.report_types')->with([
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'Report Information'
        ]);
    }
    //escort Guide page
    public function escortGuide()
    {
        $web = GeneralSetting::find(1);

        return view('home.escort_guide')->with([
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'Escort Guide'
        ]);
    }
}
