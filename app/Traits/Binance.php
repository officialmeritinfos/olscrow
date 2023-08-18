<?php

namespace App\Traits;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Binance
{
    //fetch the USDTNGN rate
    public function fetchUsdtNgnRate($symbol)
    {
        try {
            $response = Http::get('https://api.binance.com/api/v3/ticker/price', ['symbol' => $symbol]);

            if ($response->successful()){
                $response = $response->json();
                return $response['price'];//return rate
            }else{
                Log::info($response);
            }

        }catch (\Exception $exception){
            Log::info($exception->getMessage());
        }
    }
}
