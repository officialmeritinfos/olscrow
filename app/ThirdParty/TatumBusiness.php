<?php

namespace App\ThirdParty;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class TatumBusiness
{
    private mixed $tatumBusiness,$businessUrl;

    public function __construct()
    {
        $tatumEnv = config('constant.tatum.isLive');
        $tatum = match ($tatumEnv) {
            1 => config('constant.tatum.solutions.business.live'),
            default => config('constant.tatum.solutions.business.test'),
        };
        $this->tatumBusiness = $tatum;
        $this->businessUrl= config('constant.tatum.url');
    }
    //generate wallet
    public function generateWallet($urlCode,$testNet=null): PromiseInterface|Response
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness
        ])->get($this->businessUrl.$urlCode.'/wallet');
    }
    //generate address
    public function generateAddress($id,$testNet=null): PromiseInterface|Response
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness
        ])->post($this->businessUrl.'offchain/account/'.$id.'/address');
    }
    //create a virtual account
    public function createVirtualAddress($data,$testNet=null): PromiseInterface|Response
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness,
        ])->post($this->businessUrl.'ledger/account',$data);
    }
    //create notification subscription
    public function createNotificationSubscription($data,$testNet=null): PromiseInterface|Response
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness,
        ])->post($this->businessUrl.'subscription',$data);
    }
    //generate private key
    public function generatePrivateKey($data,$testNet=null): PromiseInterface|Response
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness
        ])->post($this->businessUrl.'ethereum/wallet/priv',$data);
    }
    //fetch the gas fees of eth like chain
    public function calculateEthLikeGasFee($data,$urlCode): PromiseInterface|Response
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness
        ])->post($this->businessUrl.$urlCode.'/gas',$data);
    }
    //calculate fee for btc-like chains
    public function calculateBtcLikeChainFee($data)
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness
        ])->post($this->businessUrl.'offchain/blockchain/estimate',$data);
    }
    //fetch usd rate
    public function fetchCryptoRate($asset)
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness
        ])->get($this->businessUrl.'tatum/rate/'.$asset.'?basePair=USD');
    }
    //update balance
    public function getAccountBalance($id)
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness
        ])->get($this->businessUrl.'ledger/account/'.$id.'/balance');
    }
    //process offchain transfers
    public function processOffchainTransfer($url,$data)
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness
        ])->post($this->businessUrl.'offchain/'.$url.'/transfer',$data);
    }
    //fetch exchange rates
    public function fetchExchangeRates($fiat)
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness
        ])->get($this->businessUrl.'tatum/rate/'.$fiat.'?basePair=USD');
    }
    //precalculate wallet
    public function precalculateWallet($data)
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness
        ])->post($this->businessUrl.'gas-pump',$data);
    }
    //assign address to virtual account
    public function assignAddressToVirtualAccount($accountId,$address)
    {
        return Http::withHeaders([
            'x-api-key' => $this->tatumBusiness
        ])->post($this->businessUrl.'offchain/account/'.$accountId.'/address/'.$address);
    }
}
