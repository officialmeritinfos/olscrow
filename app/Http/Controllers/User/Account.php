<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\UserDeposit;
use App\Models\UserTransaction;
use App\Notifications\CustomNotification;
use App\Traits\Flutterwave;
use App\Traits\Regular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class Account extends BaseController
{
    use Regular;
    //landing page
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        return view('dashboard.pages.account')->with([
            'user'=>$user,
            'pageName'=>'Account Balance',
            'siteName'=>$web->name,
            'web'=>$web,
            'deposits'=>UserDeposit::where('user',$user->id)->paginate(15)
        ]);
    }
    //process account top up
    public function processAccountFunding(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(),[
                'amount'=>['required','numeric','min:100','max:500000'],
            ],[
                'min'=>'Amount cannot be less than '.$user->mainCurrency.'100',
                'max'=>'Amount cannot be more than '.$user->mainCurrency.'500,000',
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error',['error'=>$validator->errors()->all()]);

            $input = $validator->validated();

            $reference = $this->generateUniqueReference('user_deposits','reference',20);
            //collate the data to generate account
            $dataCollate = [
                'email'=>$user->email,
                'currency'=>'NGN',
                'amount'=>$input['amount'],
                'tx_ref'=>$reference,
                'is_permanent'=>false,
                'narration'=>$user->name
            ];

            //collect payment
            $gateway = new Flutterwave();
            $response = $gateway->createVirtualAccount($dataCollate);
            if ($response->ok()){
                $response = $response->json();

                if ($response['status']=='success'){
                    $dataDeposit = [
                        'user'=>$user->id,'reference'=>$reference,
                        'currency'=>'NGN',
                        'amount'=>$input['amount'],
                        'amountToPay'=>$response['data']['amount'],
                        'orderReference'=>$response['data']['order_ref'],
                        'flutterRef'=>$response['data']['flw_ref'],
                        'bank'=>$response['data']['bank_name'],
                        'accountNumber'=>$response['data']['account_number'],
                        'expiryDate'=>strtotime($response['data']['expiry_date']),
                        'channel'=>'Bank Transfer'
                    ];

                    $deposit = UserDeposit::create($dataDeposit);
                    if (!empty($deposit)){
                        return $this->sendResponse([
                            'accountNumber'=>$deposit->accountNumber,
                            'bank'=>$deposit->bank,
                            'reference'=>strtoupper($deposit->reference),
                            'amount'=>$deposit->amountToPay
                        ],$response['data']['note']);
                    }
                }
            }
            Log::info($response->json());
            return $this->sendError('funding.error',
                ['error'=>'An error occurred while processing your funding request. Please try again.']
            );
        }catch (Exception $exception){
            Log::alert($exception->getMessage());
            return $this->sendError('error',['error'=>'Internal Server error']);
        }
    }
    //convert escort balance
    public function convertMainBalance(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'amount' => ['required', 'numeric'],
                'account' => ['required', 'numeric','integer'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);

            $input = $validator->validated();

            //check for balance
            if ($user->accountBalance <$input['amount']){
                return $this->sendError('balance.error',['error'=>'Insufficient balance in account']);
            }

            $balanceAfter =$user->accountBalance-$input['amount'];
            $user->accountBalance = $user->accountBalance-$input['amount'];

            switch ($input['account']){
                case 1:
                    $balance = $user->subscriptionBalance;
                    $newBalance = $balance+$input['amount'];
                    $user->subscriptionBalance = $newBalance;
                    $account = 'subscription';
                    break;
                default:
                    $balance = $user->penaltyBalance;
                    $newBalance = $balance+$input['amount'];
                    $user->penaltyBalance = $newBalance;
                    $account = 'penalty';
                    break;
            }
            $transaction = UserTransaction::create([
                'user'=>$user->id,'reference'=>$this->generateUniqueReference('user_transactions','reference',20),
                'amount'=>$input['amount'],'type'=>2,'currency'=>'NGN','accountTo'=>$account,
                'newBalance'=>$balanceAfter
            ]);
            if (!empty($transaction)){
                $user->save();

                return $this->sendResponse([
                    'redirectTo'=>url()->previous()
                ],'Conversion was successful.');
            }
        }catch (\Exception $exception){
            Log::alert($exception->getMessage().' on line '.$exception->getLine().' on '.$exception->getFile());
            return $this->sendError('error',['error'=>'Internal Server error']);
        }
    }
    //convert referral balance
    public function convertReferralBalance(Request $request)
    {
        try {
            $user = Auth::user();
            $web = GeneralSetting::find(1);
            $validator = Validator::make($request->all(), [
                'amount' => ['required', 'numeric'],
            ])->stopOnFirstFailure();

            if ($validator->fails()) return $this->sendError('validation.error', ['error' => $validator->errors()->all()]);

            $input = $validator->validated();

            //check for balance
            if ($user->referralBalance <$input['amount']){
                return $this->sendError('balance.error',['error'=>'Insufficient balance in referral account']);
            }

            $balanceAfter =$user->referralBalance-$input['amount'];
            $user->referralBalance = $user->referralBalance-$input['amount'];

            $balance = $user->accountBalance;
            $newBalance = $balance+$input['amount'];
            $user->accountBalance = $newBalance;
            $account = 'account';


            $transaction = UserTransaction::create([
                'user'=>$user->id,'reference'=>$this->generateUniqueReference('user_transactions','reference',20),
                'amount'=>$input['amount'],'type'=>2,'currency'=>'NGN','accountTo'=>$account,
                'newBalance'=>$balanceAfter
            ]);
            if (!empty($transaction)){
                $user->save();

                return $this->sendResponse([
                    'redirectTo'=>url()->previous()
                ],'Conversion was successful.');
            }
        }catch (\Exception $exception){
            Log::alert($exception->getMessage().' on line '.$exception->getLine().' on '.$exception->getFile());
            return $this->sendError('error',['error'=>'Internal Server error']);
        }
    }
}
