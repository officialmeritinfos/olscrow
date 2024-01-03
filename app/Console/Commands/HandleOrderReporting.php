<?php

namespace App\Console\Commands;

use App\Models\BookingReport;
use App\Models\User;
use App\Models\UserBooking;
use App\Traits\Regular;
use Illuminate\Console\Command;

class HandleOrderReporting extends Command
{
    use Regular;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'handle:orderReporting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handles Order Reporting';

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
        $this->notifyOrderReportedNotAppealed();
        $this->notifyOrderReportedAppealed();
    }
    //notify support when order was reported and not appealed
    public function notifyOrderReportedNotAppealed()
    {
        $bookings = UserBooking::where('status',4)
            ->where('reported',1)->where('appealed','!=',1)
            ->where('timeToAppeal','<=',time())->get();
        if ($bookings->count()>0){
            foreach ($bookings as $booking) {
                $report = BookingReport::where('bookingId',$booking->id)->where('status',4)->where('timeToAppeal','<=',time())->first();

                $report->status=5;
                $report->save();

                $message="An escort booking with ID ".$booking->reference." which was reported by the booker has not been
                appealed by the Escort and time is up. your attention is needed to take a decision about this.";
                $this->sendMailToAdmin('Booking Report Needs Attention',$message);
            }
        }
    }
    //notify when an order was reported, appealed but needs support intervention
    public function notifyOrderReportedAppealed()
    {
        $bookings = UserBooking::where('status',4)
            ->where('reported',1)->where('appealed',1)->get();
        if ($bookings->count()>0){
            foreach ($bookings as $booking) {

                $report = BookingReport::where('bookingId',$booking->id)->where('status',4)->where('timeSupportIntervene','<=',time())->first();
                if (!empty($report)){
                    $report->status=5;
                    $report->save();
                    $message="An escort booking with ID ".$booking->reference." which was reported by the booker and was
                appealed by the Escort needs your attention as both parties have failed to reach a consensus. Report ID is ".$report->reference;
                    $this->sendMailToAdmin('Booking Report Needs Attention',$message);
                }
            }
        }
    }
}
