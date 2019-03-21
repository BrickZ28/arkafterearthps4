<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    public $guarded = [];

    public function storeOwner () {
        return $this->belongsTo('App\User', 'owner_id', 'id');
    }

    public function items(){
        return $this->hasMany('App\Item');
    }
}
