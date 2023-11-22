<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseController
{
    //landing page
    public function landingPage()
    {
        $user = Auth::user();
        if ($user->accountType==1){
            $type ='Escort';
        }else{
            $type = 'User';
        }
        $web = GeneralSetting::find(1);

        return view('dashboard.home')->with([
            'web'=>$web,
            'pageName'=>$type.' Dashboard',
            'type'=>$type,
            'siteName'=>$web->name,
            'user'=>$user
        ]);
    }
}
