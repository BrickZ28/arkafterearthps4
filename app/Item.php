<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $guarded = [];

    public function storeItem(){
        return $this->belongsTo('App\Store', 'id', 'store_id');
    }
}
