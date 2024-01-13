<?php

namespace App\Console\Commands;

use App\Models\EscortSubscriptionPayment;
use App\Models\GeneralSetting;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\CustomNotification;
use App\Notifications\SendPushNotification;
use App\Traits\Regular;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UserRenewalCron extends Command
{
    use Regular;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:renewalCron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This scheduler handles all user subscriptions';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->handleUserSubscription();
        $this->handleUserAddonFeature();
    }
    //handle user subscription
    public function handleUserSubscription()
    {
        try {

            $web = GeneralSetting::find(1);

            $users = User::where('isEnrolled', 1)->where('accountType', 1)->where('subRenewalDate', '<=', time())->get();
            if ($users->count() > 0) {
                foreach ($users as $user) {
                    $package = Package::where('id', $user->package)->first();
                    //check if package renews
                    if ($user->renewSubscription != 1) {
                        $user->isEnrolled = 2;
                        $user->isPublic = 2;
                        $user->fetaured = 2;

                        $user->save();
                        $pushMessage = "Your subscription to " . $package->name . " package on " . $web->name . " has been cancelled, and account deactivated. Reactivate now!";
                        $user->notify(new SendPushNotification($user, 'Subscription Cancellation', $pushMessage));
                        $message = "
                            Your subscription to " . $package->name . " package on " . $web->name . " has expired, and your profile deactivated. <br/>
                            Login now and reactivate your profile by enrolling in any of the packages. We also have a free package that you can enjoy.<br/>
                            If you are not pleased with our service, please do let us know what we can do to make it better for you by sending us a response
                            to " . $web->feedbackMail . " and we will follow you up.";
                        $user->notify(new CustomNotification($user, 'Subscription Cancellation', $message));
                    } elseif ($user->nextRetry <= time()) {
                        //check if the user is on free package
                        if ($package->isFree == 1) {
                            $user->subRenewalDate = strtotime('1 Year', time());
                            $user->save();
                            $pushMessage = "Your free subscription has been renewed. Thanks for using " . $web->name;
                            $user->notify(new SendPushNotification($user, 'Subscription Renewal', $pushMessage));

                            $message = "Your free subscription has been renewed. Thanks for using " . $web->name;
                            $user->notify(new CustomNotification($user, 'Subscription Renewal', $message));
                        } else {
                            //find the last subscription amount paid
                            $subscription = EscortSubscriptionPayment::where('user', $user->id)->where('package', $package->id)->orderBy('id', 'desc')->first();
                            $userBalance = $user->subscriptionBalance;
                            $amountToCharge = $subscription->amount;
                            //check if the balance is sufficient
                            if ($userBalance < $amountToCharge) {
                                //check the number of times attempt has been made
                                $attempts = $user->numberRetry + 1;
                                $attemptLeft = $web->subscriptionChargeRetry - $attempts;
                                if ($attempts == $web->subscriptionChargeRetry) {
                                    //cancel the subscription
                                    $user->isEnrolled = 2;
                                    $user->isPublic = 2;
                                    $user->fetaured = 2;
                                    $user->save();

                                    //notify user
                                    $pushMessage = "Your subscription to " . $package->name . " package on " . $web->name . " has been cancelled after several attempts to renew it, and profile deactivated. Reactivate now!";
                                    $user->notify(new SendPushNotification($user, 'Subscription Cancellation', $pushMessage));
                                    $message = "
                                    Your subscription to " . $package->name . " package on " . $web->name . " has been cancelled after several failed attempts to renew it, and your profile deactivated. <br/>
                                    Login now and reactivate your profile by enrolling in any of the packages. We also have a free package that you can enjoy.<br/>
                                    If you are not pleased with our service, please do let us know what we can do to make it better for you by sending us a response
                                    to " . $web->feedbackMail . " and we will follow you up.";
                                    $user->notify(new CustomNotification($user, $message, 'Subscription Cancellation'));
                                } else {
                                    $user->numberRetry = $user->numberRetry + 1;
                                    $user->nextRetry = strtotime('24 Hour', time());
                                    $user->save();
                                    $pushMessage = "Your subscription on " . $web->name . " failed to renew due to insufficient balance. Please fund your subscription balance.";
                                    $user->notify(new SendPushNotification($user, 'Failed Subscription Renewal', $pushMessage));
                                    $message = "
                                    Your subscription to " . $package->name . " package on " . $web->name . " failed to renew due to insufficient balance.
                                    Your current balance is " . $user->mainCurrency . number_format($userBalance, 2) . "
                                    but a total balance of " . $user->mainCurrency . number_format($amountToCharge, 2) . " is needed to
                                    renew your package. Please fund your subscription balance. We will attempt this charge " . $attemptLeft . " times.";
                                    $user->notify(new CustomNotification($user, $message, 'Failed Subscription Renewal'));
                                }

                            } else {
                                $newBalance = $userBalance - $amountToCharge;
                                $user->subscriptionBalance = $newBalance;
                                if ($user->enrollmentType == 1) {
                                    $user->subRenewalDate = strtotime('1 Month', $user->subRenewalDate);
                                    $duration = "1 month";
                                } else {
                                    $user->subRenewalDate = strtotime('1 Year', $user->subRenewalDate);
                                    $duration = "1 Year";
                                }
                                $payment = EscortSubscriptionPayment::create([
                                    'user' => $user->id, 'reference' => $this->generateUniqueReference('escort_subscription_payments', 'reference', 20),
                                    'package' => $package->id, 'amount' => $amountToCharge, 'currency' => $user->mainCurrency,
                                    'balanceAfter' => $newBalance
                                ]);
                                Transaction::create([
                                    'user' => $user->id, 'reference' => $this->generateUniqueReference('transactions', 'reference', 20),
                                    'currency' => $user->mainCurrency, 'amount' => $amountToCharge, 'purpose' => 'For subscription renewal',
                                    'orderId' => $payment->id, 'type' => 2, 'status' => 1
                                ]);
                                $user->save();
                                //send user receipt
                                $message = "
                                    Your subscription to <b>" . $package->name . "</b> on <b>" . $web->name . "</b> has been renewed. The Details are as follow:<br/>
                                    <hr/>
                                    <p><b>Amount:</b> " . $user->mainCurrency . number_format($amountToCharge, 2) . "</p>
                                    <p><b>Reference:</b> " . $payment->reference . "</p>
                                    <p><b>Account Debited:</b> Subscription Balance</p>
                                    <p><b>New Balance:</b> " . $user->mainCurrency . number_format($newBalance, 2) . "</p>
                                    <p><b>Duration:</b> " . $duration . "</p>
                                ";
                                $pushMessage = "Your subscription on " . $web->name . " has been renewed. " . $user->mainCurrency . number_format($amountToCharge, 2) . " was charged.";
                                $user->notify(new SendPushNotification($user, 'Successful Subscription Renewal', $pushMessage));
                                $user->notify(new CustomNotification($user, $message, 'Subscription Renewal'));
                            }
                        }
                    }
                }
            }
        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on line '.$exception->getLine().' in file '.$exception->getFile());
        }
    }
    //handle user addon feature
    public function handleUserAddonFeature()
    {
        try {

            $web = GeneralSetting::find(1);

            $users = User::where('hasAddon', 1)->where('accountType', 1)->where('featuredEnd', '<=', time())->get();
            if ($users->count() > 0) {
                foreach ($users as $user) {
                    if ($user->fetaured==1){
                        $user->fetaured=2;
                        $user->hasAddon=2;
                        $user->featuredEnd='';
                        $user->save();

                        $pushMessage = "Your subscription on " . $web->name . " to the Featured Addon has expired and account featuring deactivated. Please repurchase if you want to continue enjoying this feature. ";
                        $user->notify(new SendPushNotification($user, 'Featured Addon Expired', $pushMessage));
                        $message = "
                            Your subscription to the Featured Addon on ".$web->name." has expired, and the premium addon turned off on your account.
                            Please resubscribe if you want to continue enjoying the premium service or subscribe to a package to keep your featuring
                            active.
                        ";
                        $user->notify(new CustomNotification($user, $message, 'Failed Subscription Renewal'));
                    }
                }
            }
        }catch (\Exception $exception){
            Log::info($exception->getMessage().' on line '.$exception->getLine().' in file '.$exception->getFile());
        }
    }
}
