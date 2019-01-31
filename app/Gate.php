<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gate extends Model
{
    protected $guarded = [];

    public function usergate(){
        return $this->hasOne('App\User', 'id', 'player');
    }
    public function givenBy(){
        return $this->hasOne('App\User', 'id', 'admin');
    }
}
