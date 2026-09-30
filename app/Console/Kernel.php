<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    // protected function schedule(Schedule $schedule)
    // {
    //     // Run the command every 20 minutes
    //     $schedule->command('alert:meetings')->everyTenMinutes();
    // }

    protected function schedule(Schedule $schedule)
    {
        // Meeting alert emails switched off 2026-09-30. Uncomment the line below to turn them back on.
        // $schedule->command('alert:meetings')->everyMinute();
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
