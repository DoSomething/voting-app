<?php

namespace VotingApp\Listeners;

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
        StatHat::ezCount(env('STATHAT_APP_NAME', 'votingapp').' - vote');
    }
}
