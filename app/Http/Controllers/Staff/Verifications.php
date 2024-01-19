<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\EscortVerification;
use App\Models\GeneralSetting;
use App\Models\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Verifications extends BaseController
{
    //completed page
    public function completed()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.verifications.index')->with([
            'web'           =>$web,
            'siteName'      =>$web->name,
            'pageName'      =>'Completed Verifications',
            'user'          =>$user,
            'escorts'       =>EscortVerification::where('status',1)->orderBy('id','desc')->paginate(15),
            'clients'       =>UserVerification::where('status',1)->orderBy('id','desc')->paginate(15,'*','client')
        ]);
    }
    //pending page
    public function pending()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.verifications.index')->with([
            'web'           =>$web,
            'siteName'      =>$web->name,
            'pageName'      =>'Pending Verifications',
            'user'          =>$user,
            'escorts'       =>EscortVerification::where('status','!=',1)->orderBy('id','desc')->paginate(15),
            'clients'       =>UserVerification::where('status','!=',1)->orderBy('id','desc')->paginate(15,'*','client')
        ]);
    }
    //verification detail
    public function verificationDetail($id)
    {

    }
}
