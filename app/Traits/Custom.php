<?php

namespace App\Traits;

use App\Models\Business;
use App\Models\BusinessCryptoWithdrawal;
use App\Models\BusinessCustomer;
use App\Models\BusinessInvoiceProduct;
use App\Models\BusinessPayoutAccount;
use App\Models\City;
use App\Models\Coin;
use App\Models\Country;
use App\Models\Department;
use App\Models\EscortProfile;
use App\Models\EscortReview;
use App\Models\Fiat;
use App\Models\Order;
use App\Models\Service;
use App\Models\State;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserBank;
use App\Models\UserBooking;
use App\Models\UserFeature;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Custom
{
    use Regular;
    //fetch user notifications
    public function fetchUserActivities($user)
    {
        return UserActivity::where(['user'=>$user,'status'=>2])->orderBy('id','desc')->limit(10)->get();
    }
    //fetch a coin detail
    public function getCoinDetail($asset): Coin
    {
        return Coin::where('asset',$asset)->first();
    }
    public function decryptWord($string): string
    {
        return Crypt::decryptString($string);
    }
    //abridge sentence
    public function abridgeSentence($word,$length=10): string
    {
        return Str::words($word,$length);
    }
    //get time ago
    public function getTimeAgo($date): string
    {
        return Carbon::parse($date)->diffForHumans();
    }
    //shorten number to letter
    public function shortenNumberToLetters($number): string
    {
        return $this->shortenNumberToLetter($number);
    }
    //fetch user detail by id
    public function getUserById($id): User
    {
        return User::where('id',$id)->first();
    }
    //fetch order by id
    public function getOrderById($id)
    {
        return Order::where('id',$id)->first();
    }
    //fetch country by code
    public function getCountryByCode($code)
    {
        return Country::where('iso3',$code)->first();
    }
    //fetch state by id
    public function getStateById($id)
    {
        return State::where('id',$id)->first();
    }
    //fetch state by id
    public function getCityById($id)
    {
        return City::where('id',$id)->first();
    }
    //fetch escort profile
    public function fetchEscortProfile($id)
    {
        return EscortProfile::where('user',$id)->first();
    }
    //escort reviews
    public function fetchEscortReviews($id)
    {
        return EscortReview::where('user',$id)->where('status',1)->get();
    }
    //user features
    public function getUserFeature($id)
    {
        return UserFeature::where('id',$id)->first();
    }
    //get user age
    public function convertToAge($timestamp)
    {
        $birthdate = Carbon::createFromTimestamp($timestamp);
        return $birthdate->diffInYears(Carbon::now());
    }
    //user service
    public function getServiceById($id)
    {
        return Service::where('id',$id)->first();
    }
    //get user payout accounts
    public function userPayoutAccounts($user)
    {
        if (strtoupper($user->countryCode)=='NGA'){
            return UserBank::where('user',$user->id)->get();
        }else{

        }
    }
    //fetch a particular payout account
    public function fetchPayoutAccountByReference($id)
    {
        return UserBank::where('reference',$id)->first();
    }
    //total escorts
    public function totalActiveEscorts()
    {
        return User::where('accountType',1)->where('status',1)->get()->count();
    }
    //total transactions
    public function completedBooking()
    {
        return UserBooking::where('status',1)->get()->count();
    }
}
