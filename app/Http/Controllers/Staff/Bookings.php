<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\UserBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Bookings extends BaseController
{
    //completed bookings
    public function completedBookings()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.bookings.index')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Completed Booking',
            'user'      =>$user,
            'bookings'  =>UserBooking::where('status',1)->paginate(15),
            'total'     =>UserBooking::where('status',1)->get()
        ]);
    }
    //pending bookings
    public function pendingBookings()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.bookings.index')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Pending Booking',
            'user'      =>$user,
            'bookings'  =>UserBooking::where('status',2)->paginate(15),
            'total'     =>UserBooking::where('status',2)->get()
        ]);
    }
    //reported Booking
    public function reportedBookings()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.bookings.reported')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Reported Booking',
            'user'      =>$user,
            'bookings'  =>UserBooking::where('status','!=',1)->where('reported',1)->paginate(15),
            'total'     =>UserBooking::where('status','!=',1)->where('reported',1)->get()
        ]);
    }
    //ongoing booking
    public function ongoingBookings()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.bookings.index')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Ongoing Booking',
            'user'      =>$user,
            'bookings'  =>UserBooking::where('status',4)->where('reported','!=',1)->paginate(15),
            'total'     =>UserBooking::where('status',4)->where('reported','!=',1)->get()
        ]);
    }
    //booking detail
    public function bookingDetail($id)
    {

    }
}
