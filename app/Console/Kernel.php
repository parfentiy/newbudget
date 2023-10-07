<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
<<<<<<< HEAD
     */
    protected function schedule(Schedule $schedule): void
=======
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27
    {
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
<<<<<<< HEAD
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
=======
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
>>>>>>> 1e03a7501220e7f7749dc0dc3d824ac3c6af1b27

        require base_path('routes/console.php');
    }
}
