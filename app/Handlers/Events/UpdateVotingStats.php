<?php namespace VotingApp\Handlers\Events;

use StatHat;

class UpdateVotingStats
{

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        if (app()->environment('local')) {
            return;
        }

        // Log this event to stathat.
        StatHat::ezCount(env('STATHAT_APP_NAME', 'votingapp') . ' - vote');
    }

}
