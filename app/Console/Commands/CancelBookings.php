<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\User;
use App\Models\UserBooking;
use App\Notifications\CustomNotification;
use App\Notifications\SendPushNotification;
use App\Traits\Regular;
use Illuminate\Console\Command;

class CancelBookings extends Command
{
    use Regular;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancel:bookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel bookings automatically';

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
        $this->cancelBookingNotAcceptedByEscort();
        $this->completeBookingNotRespondedByBooker();
    }
    //cancel bookings not accepted by escort
    public function cancelBookingNotAcceptedByEscort()
    {
        $bookings = UserBooking::where('status',2)->where('timeAcceptBooking','<=',time())->get();
        if ($bookings->count()>0){
            foreach ($bookings as $booking) {
                $booker = User::where('id',$booking->user)->first();
                $escort = User::where('id',$booking->escortId)->first();
                $booking->status = 3;
                $booker->accountBalance = $booker->accountBalance+$booking->amount;


                $booking->save();
                $booker->save();

                $transReference = $this->generateUniqueReference('transactions','reference');
                Transaction::create([
                    'user'=>$booker->id,'reference'=>$transReference,
                    'currency'=>$booking->currency,'amount'=>$booking->transportFee,
                    'purpose'=>'Refund for Escort Booking '.$booking->reference,'orderId'=>$booking->id,'status'=>1,'type'=>2
                ]);

                $bookerMessage = "Your escort booking with ID ".$booking->reference." has been cancelled as order was not accepted by escort in time. We are sorry for the inconveniences.";
                //send push message to booker
                $booker->notify(new SendPushNotification($booker,'Booking cancelled',$bookerMessage));

                $escortMessage = "Due to your inability to accept the booking ".$booking->reference." within the timeframe provided, we have cancelled the booking and refunded the booker";
                $escort->notify(new SendPushNotification($escort,'Booking cancelled',$escortMessage));
            }
        }
    }
    //complete bookings delivery not responded to by booker
    public function completeBookingNotRespondedByBooker()
    {
        $bookings = UserBooking::where([
            'status'=>4,'approvedByEscort'=>1,
        ])->where('timeToApproveByClient','<=',time())
            ->where('approvedByUser','!=',1)
            ->where('reported','!=',1)
            ->get();
        if ($bookings->count()>0){
            foreach ($bookings as $booking) {
                $user = User::where('id',$booking->user)->first();
                $escort = User::where('id',$booking->escortId)->first();

                $amountCredit = 0;
                if ($booking->requestForTransport==1 && $booking->transportStatus==1){
                    $amountCredit = $amountCredit+$booking->transportFee;
                    $escort->transportBalance = $escort->transportBalance-$booking->transportFee;
                }
                $amountCredit = $amountCredit+$booking->amountCredit;
                $escort->accountBalance = $escort->accountBalance+$amountCredit;//credit escort

                $transReference = $this->generateUniqueReference('transactions','reference');
                Transaction::create([
                    'user'=>$escort->id,'reference'=>$transReference,
                    'currency'=>$booking->currency,'amount'=>$booking->transportFee,
                    'purpose'=>'Payment for booking '.$booking->reference,'orderId'=>$booking->id,'status'=>1,'type'=>1
                ]);
                $tranReference = $this->generateUniqueReference('transactions','reference');
                Transaction::create([
                    'user'=>$escort->id,'reference'=>$tranReference,
                    'currency'=>$booking->currency,'amount'=>$booking->transportFee,
                    'purpose'=>'Payment for Tfare for booking '.$booking->reference,'orderId'=>$booking->id,'status'=>1,'type'=>1
                ]);


                $escort->save();
                $booking->approvedByUser=1;
                $booking->status=1;
                $booking->save();

                //notify booker & escort
                $message = "Your booking with $user->username has been marked as delivered since client failed to take action. Your funds have been released into your account.";
                $escort->notify(new SendPushNotification($escort,'Escort Booking delivery',$message));
                $escort->notify(new CustomNotification($escort,$message,'Escort Booking delivery'));
                //booker
                $bookerMessage = "Your booking with $escort->displayName has been marked as delivered since you failed to take action. Your funds have been released into your account.";
                $user->notify(new SendPushNotification($user,'Escort Booking delivery',$bookerMessage));
                $user->notify(new CustomNotification($user,$bookerMessage,'Escort Booking delivery'));
            }
        }
    }
}
