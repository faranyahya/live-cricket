<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Team;

class Player extends Model
{

    protected $fillable = ["name", "team_id"];
    
    public function team(){
        return $this->belongsTo("App\Team");
    }
    
}
