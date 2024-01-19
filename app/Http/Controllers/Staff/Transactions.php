<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\EscortSubscriptionPayment;
use App\Models\GeneralSetting;
use App\Models\UserAddonEnrollment;
use App\Models\UserDeposit;
use App\Models\UserWithdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Transactions extends BaseController
{
    //subscriptions
    public function subscriptions()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.transactions.subscriptions')->with([
            'web'           =>$web,
            'siteName'      =>$web->name,
            'pageName'      =>'Subscriptions',
            'user'          =>$user,
            'transactions'  =>EscortSubscriptionPayment::orderBy('id','desc')->paginate(15)
        ]);
    }
    //subscription detail
    public function subscriptionDetail($id)
    {

    }
    //addon purchases
    public function addonPurchases()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.transactions.addon_purchases')->with([
            'web'           =>$web,
            'siteName'      =>$web->name,
            'pageName'      =>'Addon Purchases',
            'user'          =>$user,
            'transactions'  =>UserAddonEnrollment::orderBy('id','desc')->paginate(15)
        ]);
    }
    //addon purchase
    public function addonPurchaseDetail($id)
    {

    }
    //account funding
    public function accountFunding()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.transactions.account_funding')->with([
            'web'           =>$web,
            'siteName'      =>$web->name,
            'pageName'      =>'Account Funding',
            'user'          =>$user,
            'transactions'  =>UserDeposit::orderBy('id','desc')->orderBy('status','desc')->paginate()
        ]);
    }
    //account funding detail
    public function accountFundingDetail($id)
    {

    }
    //withdrawal
    public function withdrawals()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('staff.transactions.withdrawals')->with([
            'web'           =>$web,
            'siteName'      =>$web->name,
            'pageName'      =>'Account Withdrawals',
            'user'          =>$user,
            'transactions'  =>UserWithdrawal::orderBy('id','desc')->orderBy('status')->paginate(15)
        ]);
    }
    //account withdrawal detail
    public function withdrawalDetail($id)
    {

    }
}
