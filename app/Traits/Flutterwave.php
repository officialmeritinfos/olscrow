<?php

namespace App\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Flutterwave
{
    public $url;
    public $secKey;
    public $pubKey;
    public function __construct()
    {
        $pubKey=config('constant.flutterwave.pubKey');
        $secKey=config('constant.flutterwave.secKey');

        $this->url = config('constant.flutterwave.url');
        $this->pubKey = $pubKey;
        $this->secKey = $secKey;
    }
    //create a virtual account
    public function createVirtualAccount($data): PromiseInterface|Response
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->post($this->url.'virtual-account-numbers',$data);
    }
    //verify transaction
    public function verifyTransaction($id)
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->get($this->url.'transactions'.$id.'/verify');
    }
    //initiate withdrawal
    public function initiateWithdrawal($data): PromiseInterface|Response
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->post($this->url.'transfers',$data);
    }
    //add beneficiary
    public function addBeneficiary($data): PromiseInterface|Response
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->post($this->url.'beneficiaries',$data);
    }
    //verify account number
    public function verifyAccountNumber($data): PromiseInterface|Response
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->post($this->url.'accounts/resolve',$data);
    }
    //get banks in a country
    public function fetchBank($country): PromiseInterface|Response
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->get($this->url.'banks/'.$country);
    }
}
