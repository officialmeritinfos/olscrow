<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

class Paystack
{
    public $url;
    public $secKey;
    public $pubKey;
    public function __construct()
    {
        switch (config('constant.paystack.isLive')){
            case 1:
                $pubKey=config('constant.paystack.pubKey');
                $secKey=config('constant.paystack.secKey');
                break;
            default:
                $pubKey=config('constant.paystack.testPubKey');
                $secKey=config('constant.paystack.testSecKey');
                break;
        }
        $this->url = config('constant.paystack.url');
        $this->pubKey = $pubKey;
        $this->secKey = $secKey;
    }

    /**
     * Create customer instance
     * @param $data
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function createCustomer($data)
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->post($this->url.'customer',$data);
    }
    /**
     * fetch Nigerian banks
     * @param $country
     * @param $currency
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function getBanks($country,$currency='NGN')
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->get($this->url.'bank?country='.$country.'&perPage=100&currency='.$currency);
    }
    //verify account number
    public function verifyBankAccount($accountNumber,$bank)
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->get($this->url.'bank/resolve?account_number='.$accountNumber.'&bank_code='.$bank);
    }
    //validates users
    public function validateCustomer($customerCode,$data)
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->post($this->url.'customer/'.$customerCode.'/identification',$data);
    }
    //create bank account for customer
    public function createCustomerBank($data)
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->post($this->url.'dedicated_account',$data);
    }
    //verify card transaction
    public function verifyCardTransaction($reference)
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->get($this->url.'transaction/verify/'.$reference);
    }
    //add transfer recipient
    public function addTransferRecipient($data)
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->post($this->url.'transferrecipient',$data);
    }
    //initiate transfer
    public function initiateTransfer($data)
    {
        return Http::withHeaders([
            "Authorization" =>'Bearer '.$this->secKey
        ])->post($this->url.'transfer',$data);
    }
}
