<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File; 

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'database backup description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
        $filename = "backup_" . Carbon::now()->format('Y-m-d') . ".sql.zip";  //  .[format].[compression]. Example: .sql.zip
        // $filename = "backup_" . Carbon::now()->format('Y-m-d') . ".sql.gz";  //  .[format].[compression]. Example: .sql.zip
        // $filename = "backup_" . date("Y-m-d") . ".sql.zip";
        // Create backup folder and set permission if not exist.
        $storageAt = storage_path() . "/app/backup/";
        if(!File::exists($storageAt)) {
            File::makeDirectory($storageAt, 0755, true, true);
        }
        // $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > " . storage_path() . "/app/backup/" . $filename;
        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "   | gzip  > " . $storageAt . $filename;

        $returnVar = NULL;
        $output = NULL;
        exec($command, $output, $returnVar);
        // return 0;
    }
}
