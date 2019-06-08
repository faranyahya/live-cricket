<?php

namespace App\Listeners;

use App\Events\RunsScored;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\MatchPlayerStat;
use Illuminate\Log\Logger;

class AddingRunsToDatabase
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  RunsScored  $event
     * @return void
     */
    public function handle(RunsScored $event)
    {
        $runs = $event->runs;
        
        // add to database here, using event listener to add in database because of real-time nature of app.
        // dd('hello');
        MatchPlayerStat::insert($runs);
    }
}
