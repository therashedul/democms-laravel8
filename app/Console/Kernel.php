<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
Use DB;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        'App\Console\Commands\postUpdate',  
        'App\Console\Commands\sendSms',  
        'App\Console\Commands\DatabaseBackup',  
        //postUpdate::class,     [anothar roles]
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('minute:update')->everyMinute();
        // $schedule->command('send:sms')->everyMinute();
        $schedule->command('database:backup')->daily();
        //  $schedule->command('backup:clean')->daily()->at('01:00');

          // databae backupexec method 
    // $host = config('database.connections.mysql.host');
    // $username = config('database.connections.mysql.username');
    // $password = config('database.connections.mysql.password');
    // $database = config('database.connections.mysql.database');
    // $schedule->exec("mysqldump -h {$host} -u {$username} -p{$password} {$database}")
    //   ->daily()
    //   ->sendOutputTo('/backups/daily_backup.sql');
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
