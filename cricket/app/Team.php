<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tournament;
use App\Player;

class Team extends Model
{
    protected $fillable = ["name"];

    public function tournaments(){
        return $this->belongsToMany("App\Tournament");
    }
    
}
