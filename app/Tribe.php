<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tribe extends Model
{
    public function users(){

        return $this->belongsToMany('App\User', 'tribe_users', 'tribeName', 'tribe_id');
    }
}
