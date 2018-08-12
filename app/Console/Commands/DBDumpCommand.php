<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class DBDumpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump database data';

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
     * @return mixed
     */
    public function handle()
    {
        $ds = DIRECTORY_SEPARATOR;
        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');
        $path = storage_path('app' . $ds . 'backup' . $ds);
        $str = 's/\\\\\\\'/\'\'/g';
        $file = (\Carbon\Carbon::now())->format('Y-d-m-G-i-s') . '-dump-' . $database . '.sql';
        $command = sprintf('mysqldump -h %s -u %s -p %s --no-create-info --ignore-table=%s.migrations -B %s > %s', 
        $host, $username, $password, $database, $database, $path . $file);

            
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        
        exec($command);
        
        $file_contents = file_get_contents($path . $file);
        $file_contents = str_replace("\'","''",$file_contents);
        file_put_contents($path . $file,$file_contents);

        $this->info($command);
        $this->info('Backup created: ' . $file);
    }
}
