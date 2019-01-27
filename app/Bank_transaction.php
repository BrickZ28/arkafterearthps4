<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank_transaction extends Model
{
    protected $table = 'bank_transactions';
    protected $guarded = [];

    public function payer(){
        return $this->belongsTo('App\User', 'payer_id');
    }
    public function receiver(){
        return $this->belongsTo('App\User', 'receiver_id');
    }
}
