<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserBooking;
use App\Notifications\SendPushNotification;
use Illuminate\Console\Command;

class CancelBookings extends Command
{
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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->cancelBookingNotAcceptedByEscort();
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

                $bookerMessage = "Your escort booking with ID ".$booking->reference." has been cancelled as order was not accepted by escort in time. We are sorry for the inconveniences.";
                //send push message to booker
                $booker->notify(new SendPushNotification($booker,'Booking cancelled',$bookerMessage));

                $escortMessage = "Due to your inability to accept the booking ".$booking->reference." within the timeframe provided, we have cancelled the booking and refunded the booker";
                $escort->notify(new SendPushNotification($escort,'Booking cancelled',$escortMessage));
            }
        }
    }
}
