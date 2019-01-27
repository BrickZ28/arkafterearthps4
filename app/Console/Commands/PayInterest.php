<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use DB;
use App\Bank;

class PayInterest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PayInterest:payinterest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pay out earned interest';

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
        $users = User::whereNotNull('gem_balance')->get();
        $banks_info = Bank::first();
        $usersBal = $users[0]->gem_balance;


        foreach($users as $user) {
            $interestEarned = ($usersBal * ($banks_info->interest_rate / 100)) ;
            $usersBal += round($interestEarned);
            $user->gem_balance = $usersBal;
            $user->save();
        }
    }
}
