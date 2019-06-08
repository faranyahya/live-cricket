<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\RunsScored;
use Pusher\Pusher;
use App\Tournament;
use App\MatchTeam;
use App\Match;

class RunsController extends Controller
{
    // testing event fire @ route score/runs 
    public function create(){
        $runs = ["player_id" => 1, "match_ball_id" => 2, "score" => 2, "playing_status" => 0];
        event(new RunsScored($runs));
        dd($runs);
    }

    public function simulate(){
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );
        $pusher = new Pusher(
            '0cbb9d3e60d2f0cc09c2',
            '2462b045e8cd1f99d1b9',
            '799777',
            $options
        );

        $pusher->trigger('my-channel', 'my-event', ["message" => "Tournament Started!", "matches" => null]);
        
        $this->init();

        $data = ["message" => "Tournament started!", "matches" => ["Pakistan vs India", "Srilanka vs Bangladesh"]];
        $pusher->trigger('my-channel', 'my-event', $data);

        // start each match with defined timer..
    }

    public function init(){
        $matches = [];
        $tournament = Tournament::find(1);
        // pre-defined fixtures for matches 
        $fixtures = [1 => 2, 3 => 4];

        foreach($fixtures as $team1 => $team2){            
            $match = new Match();
            $match->tournament_id = $tournament->id;
            $match->stadium = "Anonymous";
            $match->save();
            
            $matchTeam1 = new MatchTeam();     
            $matchTeam1->match_id = $match->id;
            $matchTeam1->team_id = $team1;
            $matchTeam1->save();
            
            $matchTeam2 = new MatchTeam();     
            $matchTeam2->match_id = $match->id;
            $matchTeam2->team_id = $team2;                
            $matchTeam2->save();

            $matches[] = $match;
        }
        

    }

    public function runsScored(){

    }

}
