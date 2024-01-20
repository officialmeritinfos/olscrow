<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\EscortPhoto;
use App\Models\EscortProfile;
use App\Models\EscortReview;
use App\Models\EscortSubscriptionPayment;
use App\Models\EscortVerification;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserBank;
use App\Models\UserBooking;
use App\Models\UserDeposit;
use App\Models\UserSetting;
use App\Models\UserTransaction;
use App\Models\UserWithdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Users extends BaseController
{
    //escort
    public function escorts()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.users.escorts')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Escort Lists',
            'user'      =>$user,
            'escorts'   =>User::where('accountType',1)->where('isStaff','!=',1)
                ->orderBy('status','asc')
                ->orderBy('id','desc')
                ->paginate(15)
        ]);
    }
    //clients
    public function clients()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.users.clients')->with([
            'web'       =>$web,
            'siteName'  =>$web->name,
            'pageName'  =>'Client Lists',
            'user'      =>$user,
            'clients'   =>User::where('accountType',2)->where('isStaff','!=',1)
                ->orderBy('status','asc')
                ->orderBy('id','desc')
                ->paginate(15)
        ]);
    }
    //escort detail
    public function escortDetails($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        $escort = User::where('reference',$id)->firstOrFail();

        return view('staff.users.escort_detail')->with([
            'web'               =>$web,
            'siteName'          =>$web->name,
            'pageName'          =>'Escort Detail',
            'user'              =>$user,
            'escort'            =>$escort,
            'packages'          =>Order::where('user',$escort->id)->paginate(10,'*','escort_package'),
            'bookings'          =>UserBooking::where('escortId',$escort->id)->paginate(10,'*','escort_booking'),
            'deposits'          =>UserDeposit::where('user',$escort->id)->paginate(10,'*','user_deposit'),
            'transactions'      =>Transaction::where('user',$escort->id)->paginate(10,'*','transactions'),
            'userTransactions'  =>UserTransaction::where('user',$escort->id)->paginate(10,'*','user_transactions'),
            'settings'          =>UserSetting::where('user',$escort->id)->first(),
            'withdrawals'       =>UserWithdrawal::where('user',$escort->id)->paginate(10,'*','withdrawals'),
            'banks'             =>UserBank::where('user',$escort->id)->paginate(10,'*','banks'),
            'subscriptions'     =>EscortSubscriptionPayment::where('user',$escort->id)->paginate(10,'*','escort_subscriptions'),
            'photos'            =>EscortPhoto::where('user',$escort->id)->paginate(10,'*','photos'),
            'reviews'           =>EscortReview::where('user',$escort->id)->paginate(10,'*','reviews'),
            'profile'           =>EscortProfile::where('user',$escort->id)->first(),
            'verification'      =>EscortVerification::where('user',$escort->id)->first()
        ]);
    }
    //client detail
    public function clientDetails($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        $client = User::where('reference',$id)->firstOrFail();

        return view('staff.users.client_detail')->with([
            'web'               =>$web,
            'siteName'          =>$web->name,
            'pageName'          =>'Client Detail',
            'user'              =>$user,
            'client'            =>$client,
            'bookings'          =>UserBooking::where('user',$client->id)->paginate(10,'*','bookings'),
            'deposits'          =>UserDeposit::where('user',$client->id)->paginate(10,'*','user_deposit'),
            'transactions'      =>Transaction::where('user',$client->id)->paginate(10,'*','transactions'),
            'userTransactions'  =>UserTransaction::where('user',$client->id)->paginate(10,'*','user_transactions'),
            'settings'          =>UserSetting::where('user',$client->id)->first(),
            'withdrawals'       =>UserWithdrawal::where('user',$client->id)->paginate(10,'*','withdrawals'),
            'banks'             =>UserBank::where('user',$client->id)->paginate(10,'*','banks'),
            'reviews'           =>EscortReview::where('reviewer',$client->id)->paginate(10,'*','reviews'),
            'verification'      =>EscortVerification::where('user',$client->id)->first()
        ]);
    }
}
