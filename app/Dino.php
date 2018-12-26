<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dino extends Model
{
    protected $guarded = [];

    public function dinoRequests(){

        return $this->hasMany(App\DinoRequest::class);
    }
}
