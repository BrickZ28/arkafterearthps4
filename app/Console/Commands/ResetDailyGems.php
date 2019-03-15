<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\CurrencyResetLog;
use Mail;

class ResetDailyGems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ResetDailyGems:resetdailygems';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets the daily gems checker';

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
        $countOld = \DB::table('users')->
            where('daily_currency', '=',1)->
            count();

        $cron = \DB::table('users')->
            update(['daily_currency' => 0]);

        $countNew = \DB::table('users')->
        where('daily_currency', '=',1)->
        count();

        if ($cron){
            $status = 'Success';

            Mail::to('brickz28@comcast.net')->send(new CurrencyResetLog($countOld,$status,$countNew));
        }
        else{
            $status = 'Failed';

            Mail::to('brickz28@comcast.net')->send(new CurrencyResetLog($countOld,$status,$countNew));
        }

    }
}
