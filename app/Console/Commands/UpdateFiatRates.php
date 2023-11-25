<?php

namespace App\Console\Commands;

use App\Models\Fiat;
use App\ThirdParty\TatumBusiness;
use App\Traits\Binance;
use Illuminate\Console\Command;

class UpdateFiatRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:fiatRates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fiats = Fiat::where('status',1)->get();
        if ($fiats->count()>0){
            foreach ($fiats as $fiat) {
                if ($fiat->code=='NGN'){
                    $this->fetchNgnRate($fiat);
                }else{
                    $this->fetchOtherRates($fiat);
                }
            }
        }
    }
    //fetch other rates
    public function fetchOtherRates($fiat)
    {
        $tatum = new TatumBusiness();
        $res = $tatum->fetchExchangeRates($fiat->code);
        if ($res->ok()){
            $response = $res->json();
            $fiat->rate = $response['value'];
            $fiat->save();

        }
    }
    //fetch NGN parallel market rate
    public function fetchNgnRate($fiat)
    {
        $binance = new Binance();
        $res = $binance->fetchUsdtNgnRate('USDTNGN');
        $fiat->rate = $res;

        $fiat->save();
    }
}
