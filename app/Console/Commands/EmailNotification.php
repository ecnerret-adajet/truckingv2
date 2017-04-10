<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Driver;
use App\Log;
use App\Card;

class EmailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends daily email report to admin';
    protected $log;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Log $log)
    {
        parent::__construct();
        $this->log = $log;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $logs = Log::latest('LocalTime');
    }
}
