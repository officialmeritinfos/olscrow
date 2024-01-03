<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\UserBooking;
use App\Models\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        $transactions = Transaction::where('user',$user->id)->paginate(10);
        return view('dashboard.pages.transactions.index')->with([
            'user'=>$user,
            'pageName'=>'Your Transactions',
            'siteName'=>$web->name,
            'web'=>$web,
            'transactions'=>$transactions,
            'trans'=>UserTransaction::where('user',$user->id)->paginate(10,  ['*'], 'trans')
        ]);
    }
}
