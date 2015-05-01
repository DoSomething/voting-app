<?php namespace App\Handlers\Events;

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
        if (app()->environment('local')) {
            return;
        }

        StatHat::ezCount(env('STATHAT_APP_NAME', 'votingapp') . ' - user register');

    }

}
