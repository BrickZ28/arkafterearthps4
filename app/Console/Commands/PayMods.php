<?php

namespace App\Console\Commands;
use App\User;
use Illuminate\Console\Command;
use Mail;
use App\Mail\PayModLog;
use App\Bank_transaction;

class PayMods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PayMods:paymods';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pay mods weekly web currency';

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
        $mods = User::whereHas('permissions', function ($q) {
            $q->where('name', 'Mod');
        })->get();

        $totalOlds = User::whereHas('permissions', function ($q) {
            $q->where('name', 'Mod');
        })->get();

        foreach($mods as $mod){
            $mod->gem_balance;

            $mod->gem_balance += 125;

            $mod->save();

            Bank_transaction::create([
                'transaction_amount' => 125,
                'payer_id' => 0,
                'receiver_id' => $mod->id,
                'reason' => 'Weekly Salary',
                'dino_id' => null,
                'admin_payer' => null,
            ]);
        }

        if ($mods){
            $status = 'Success';


        }
        else{
            $status = 'Fail';
        }

        $owners = User::whereHas('roles', function ($q) {
            $q->where('name', 'Owner');
        })->get();

        foreach ($owners as $owner) {
            Mail::to($owner->email)->send(new PayModLog($mods, $status, $totalOlds));
        }
    }
}
