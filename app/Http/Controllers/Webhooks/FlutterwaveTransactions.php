<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\UserDeposit;
use App\Models\UserTransaction;
use App\Notifications\CustomNotification;
use App\Notifications\SendPushNotification;
use App\Traits\Flutterwave;
use App\Traits\Regular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FlutterwaveTransactions extends Controller
{
    use Regular;

    //landing page
    public function landingPage(Request $request)
    {
        try {
            //we will check that the webhook is original and originate from Flutterwave
            if ($request->hasHeader('verif-hash')){
                $hashSec = config('constant.flutterwave.secHash');
                $secretHash = $request->header('verif-hash');
                if ($hashSec ==$secretHash){
                     $jsonResponse = $request->getContent();

                    $data = json_decode($jsonResponse, true);

                    $eventType = $data['event.type'];

                    if ($eventType=='BANK_TRANSFER_TRANSACTION') {
                        return $this->bankTransfer($request);
                    }
                }
            }
            return true;

        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on '.$exception->getLine());
        }
    }
    //verify bank transfer
    public function bankTransfer($request)
    {
        $data = $request->input('data');
        $transactionId = $data['id'];
        $web = GeneralSetting::find(1);
        //verify the transaction
        if ($data['status']=='successful'){
            $amount =$data['amount'];
            $charge = $data['app_fee'];
            $amountCharged = $data['charged_amount'];
            $amountCredit = $amountCharged - $charge;
            $paymentRef = $data['flw_ref'];
            $reference = $data['tx_ref'];

            //fetch deposit
            $deposit = UserDeposit::where([
                'reference'=>$reference
            ])->where('status','!=',1)->first();

            if ($deposit->transactionId ==$transactionId){
                return true;
            }
            if (!empty($deposit)){
                $user = User::where('id',$deposit->user)->first();//find the user
                //update the deposit
                UserDeposit::where('id',$deposit->id)->update([
                    'charge'=>$charge,'amountPaid'=>$amountCharged,
                    'amountCredit'=>$amountCredit,'transactionId'=>$transactionId,
                    'paymentReference'=>$paymentRef,'status'=>1
                ]);
                //update user balance
                $user->accountBalance = $user->accountBalance+$amountCredit;
                $user->save();

                //create transaction History
                UserTransaction::create([
                    'user'=>$user->id,'reference'=>$this->generateUniqueReference('user_transactions','reference',20),
                    'amount'=>$amount,'currency'=>$data['currency'],'type'=>1,'transactionId'=>$deposit->id,
                    'status'=>1
                ]);

                //send user notification
                $message = "
                        A new deposit of <b>".$data['currency'].number_format($amountCredit,2)."</b> has been
                        credited into your account on ".$web->name.".
                    ";
                $user->notify(new CustomNotification($user,$message,'Account Credit Notification'));
                $pushMessage = "A new deposit of ".$data['currency'].number_format($amountCredit,2)." has been credited into your account on ".$web->name.".";
                $user->notify(new SendPushNotification($user,'Account Credit Notification',$pushMessage));

                return true;
            }
        }
        return response('done',200);
    }
    //verify card payment
    public function cardPayment($request)
    {

    }
}
