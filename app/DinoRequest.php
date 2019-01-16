<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DinoRequest extends Model
{
    protected $table = 'dino_requests';

    protected $guarded =[];

    public function dinos(){
        return $this->belongsTo('App\Dino','dino_id')->withDefault([
            'level' => 'NA',
            'details'=> 'NA',
            'name' => 'REMOVED'
        ]);
    }

    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
