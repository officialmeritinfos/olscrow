<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\UpdateFiatRates;
use App\Console\Commands\CancelBookings;
use App\Console\Commands\HandleOrderReporting;
use App\Console\Commands\UserRenewalCron;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
         $schedule->command('update:fiatRates')->everyFifteenMinutes();
         $schedule->command('cancel:bookings')->everyMinute();
         $schedule->command('handle:orderReporting')->everyMinute();
         $schedule->command('user:renewalCron')->everyMinute();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
