<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gate extends Model
{
    protected $guarded = [];

    public function usergate(){
        return $this->hasOne('App\user', 'id', 'player');
    }
    public function givenBy(){
        return $this->hasOne('App\user', 'id', 'admin');
    }
}
