<?php

namespace VotingApp\Handlers\Events;

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
