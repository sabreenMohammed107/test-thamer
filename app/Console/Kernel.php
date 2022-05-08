<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\CourtCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('emails:send')
        //          ->dailyAt('08:00')->withoutOverlapping();

        // $schedule->command('emails:evening-status')
        //          ->dailyAt('17:00')->withoutOverlapping();

        // $schedule->command('email:weekly-report')
        //          ->weekly()->mondays()->at('08:00')->withoutOverlapping();


        $schedule->command('court:cron')
        ->everyMinute();
        // $schedule->command('court:cron')->dailyAt('10:00');
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
