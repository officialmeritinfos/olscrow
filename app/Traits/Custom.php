<?php

namespace App\Traits;

use App\Models\Business;
use App\Models\BusinessCryptoWithdrawal;
use App\Models\BusinessCustomer;
use App\Models\BusinessInvoiceProduct;
use App\Models\BusinessPayoutAccount;
use App\Models\Coin;
use App\Models\Department;
use App\Models\Fiat;
use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class Custom
{
    use Regular;
    //fetch user notifications
    public function fetchUserActivities($user)
    {
        return UserActivity::where(['user'=>$user,'status'=>2])->orderBy('id','desc')->limit(10)->get();
    }
    //check if user has business
    public function userHasBusiness($user)
    {
        return Business::where('user',$user)->get();
    }
    //fetch a coin detail
    public function getCoinDetail($asset)
    {
        return Coin::where('asset',$asset)->first();
    }

    public function decryptWord($string)
    {
        return Crypt::decryptString($string);
    }
    //abridge sentence
    public function abridgeSentence($word,$length=10): string
    {
        return Str::words($word,$length);
    }
    //get time ago
    public function getTimeAgo($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }
    //get department
    public function getDepartmentById($id)
    {
        return Department::where('id',$id)->first();
    }
    public function getInvoiceContents($id)
    {
        return BusinessInvoiceProduct::where('invoiceId',$id)->get();
    }
    //fetch currency details
    public function getCurrencyDetails($currency)
    {
        return Fiat::where('code',$currency)->first();
    }
    //fetch business crypto withdrawal details
    public function fetchBusinessCryptoWithdrawalDetails($id)
    {
        return BusinessCryptoWithdrawal::where('id',$id)->first();
    }
    //fetch business customer details
    public function getBusinessCustomersDetails($id)
    {
        return BusinessCustomer::where('reference',$id)->first();
    }
    //fetch business customer details by Id
    public function getBusinessCustomersDetailsById($id)
    {
        return BusinessCustomer::where('id',$id)->first();
    }
    //fetch bank beneficiary details by Id
    public function getBusinessPayoutAccountById($id)
    {
        return BusinessPayoutAccount::where('id',$id)->first();
    }
    //shorten number to letter
    public function shortenNumberToLetters($number): string
    {
        return $this->shortenNumberToLetter($number);
    }
}
