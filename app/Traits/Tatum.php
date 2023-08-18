<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Tatum
{
    public function fetchCryptoRate($crypto,$fiat)
    {
        try {
            //fetch rate
            $response = Http::withHeaders([
                'x-api-key' => config('constant.tatum.solutions.business.test'),
            ])->get('https://api.tatum.io/v3/tatum/rate/' . strtoupper($crypto), ['basePair' => strtoupper($fiat)]);
            if ($response->successful()){
                $response = $response->json();
                return $response['value'];//return rate
            }else{
                Log::info($response);
            }
        }catch (\Exception $exception){
            Log::info($exception->getMessage());
        }
    }
}
