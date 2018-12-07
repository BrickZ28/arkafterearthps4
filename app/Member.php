<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'users';

    public function tribe(){

        return $this->belongsTo('App\Tribe', 'tribeName');
    }
}
