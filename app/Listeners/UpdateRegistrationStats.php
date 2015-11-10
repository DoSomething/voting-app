<?php

namespace VotingApp\Listeners;

use StatHat;

class UpdateRegistrationStats
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        StatHat::ezCount(env('STATHAT_APP_NAME', 'votingapp').' - user register');
    }
}
