<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DinoRequest extends Model
{
    protected $table = 'dino_requests';

    protected $guarded =[];

    public function dino(){
        return $this->belongsTo(App\Dino::class);
    }

    public function user(){
        return $this->belongsTo(App\User::class);
    }
}
