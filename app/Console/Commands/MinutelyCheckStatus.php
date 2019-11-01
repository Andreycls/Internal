<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Pendaftaran;
class MinutelyCheckStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an hourly email to all the users';

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
        //
        \Log::info("Cron is working fine!");
        //Pendaftaran::where('foto', 'offline')->delete();
        $this->info('All pending orders are deleted successfully!');
    }
}
