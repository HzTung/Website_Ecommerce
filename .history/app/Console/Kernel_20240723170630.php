<?php

namespace App\Console;

use App\Events\UserSessionChange;
use App\Models\Employees;
use Illuminate\Support\Facades\Cache;
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
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // realtime change user 
        $schedule->call(function () {
            $this->checkUserChange();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    private function checkUserChange()
    {
        $lastCheck = Cache::get('last_check_time', now()->subMinutes(1));
        $newUser = Employees::where('updated_at', '>', $lastCheck)->get();

        if ($newUser->isNotEmpty()) {
            event(new UserSessionChange($newUser, ' ', ''));
        }

        Cache::put('last_check_time', now());
    }
}
