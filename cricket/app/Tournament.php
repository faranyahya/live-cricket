<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Team;

class Tournament extends Model
{
    protected $fillable = ["title", "format"];

    public function teams(){
        return $this->belongsToMany('App\Team');
    }

}
