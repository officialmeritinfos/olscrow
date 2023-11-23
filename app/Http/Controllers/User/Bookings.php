<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Service;
use App\Models\UserBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Bookings extends BaseController
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        $booking = UserBooking::where('escortId',$user->id)->paginate();

        if ($user->accountType!=1){
            $booking=UserBooking::where('user',$user->id)->paginate();
        }
        return view('dashboard.pages.booking.index')->with([
            'user'=>$user,
            'pageName'=>'Your Bookings',
            'siteName'=>$web->name,
            'web'=>$web,
            'services'=>Service::where('status',1)->orderBy('name','asc')->get(),
            'bookings'=>$booking
        ]);
    }
}
