<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank_transaction extends Model
{
    protected $table = 'bank_transactions';
    protected $guarded = [];

    public function payer(){
        return $this->hasOne('App\User', 'id');
    }
    public function receiver(){
        return $this->hasOne('App\User', 'id');
    }
}
