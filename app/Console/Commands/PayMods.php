<?php

namespace App\Console\Commands;
use App\User;
use Illuminate\Console\Command;
use Mail;
use App\Mail\PayModLog;

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
        }

        if ($mods){
            $status = 'Success';
        }
        else{
            $status = 'Fail';
        }

        Mail::to('brickz28@comcast.net')->send(new PayModLog($mods, $status, $totalOlds));
        Mail::to('2003dsg@gmail.com')->send(new PayModLog($mods, $status, $totalOlds));
    }
}
