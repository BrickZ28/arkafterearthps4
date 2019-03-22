<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $guarded =[];

    public function item(){
        return $this->belongsTo('App\Item', 'item_img');
    }
}
