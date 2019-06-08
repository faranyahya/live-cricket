<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Cricket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournaments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('format');
            $table->timestamps();
        });
        Schema::create('teams', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        // Schema::create('tournament_team', function(Blueprint $table)
        // {
        //     $table->integer('id')->primary();
        //     $table->integer('tournament_id');
        //     $table->integer('team_id');
        //     $table->timestamps();
        // });
        Schema::create('players', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('team_id');
            $table->timestamps();
        });
        Schema::create('matches', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('tournament_id');
            $table->string('stadium')->nullable();
            $table->string('day_time')->nullable();
            $table->timestamps();
        });
        Schema::create('match_team', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('match_id');
            $table->unsignedInteger('team_id');
            $table->integer('score')->default(0);
            $table->integer('players_out')->default(0);
            $table->integer('extra_scores')->default(0);
            $table->timestamps();
        });
        Schema::create('match_balls', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('match_id');
            $table->integer('over_number');
            $table->integer('inning')->default(1);
            $table->timestamps();
        });
        Schema::create('match_player_stats', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('match_ball_id');
            $table->unsignedInteger('player_id');
            $table->integer('score')->default(0);
            $table->integer('playing_status')->default(0)->comment('0 = batting, 1 = bowling');
            $table->timestamps();
        });

        // default values for simulation
        \App\Tournament::create([
            'title' => "Asia Cup",
            'format' => "T20",
        ]);
        \App\Team::create([
            'name' => "Pakistan",
        ]);
        \App\Team::create([
            'name' => "India",
        ]);
        \App\Team::create([
            'name' => "Srilanka",
        ]);
        \App\Team::create([
            'name' => "Bangaldesh",
        ]);
        
        for($i = 1; $i < 12; $i++){
            \App\Player::create([
                'name' => "Player-".$i,
                'team_id' => 1,
            ]);     
        }
        for($i = 1; $i < 12; $i++){
            \App\Player::create([
                'name' => "Player-".$i,
                'team_id' => 2,
            ]);     
        }
        for($i = 1; $i < 12; $i++){
            \App\Player::create([
                'name' => "Player-".$i,
                'team_id' => 3,
            ]);     
        }
        for($i = 1; $i < 12; $i++){
            \App\Player::create([
                'name' => "Player-".$i,
                'team_id' => 4,
            ]);     
        }

        /**
         * TODO creating tables without foreign keys for now...
         * setting up foreign keys below
         * 
         **/ 
        // 
        // Schema::table('matches', function(Blueprint $table)
        // {
        //     $table->foreign('tournament_id')->references('id')->on('tournaments');
        // });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
