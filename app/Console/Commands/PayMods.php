<?php

namespace App\Console\Commands;
use App\User;
use Illuminate\Console\Command;

class PayMods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:paymods';

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

        foreach($mods as $mod){
            $mod->gem_balance += 100;
            $mod->save();
        }
    }
}
