<?php namespace App\Handlers\Events;

class UpdateRegistrationStats {

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
        $stathat_key = Config::get('services.stathat.key');
        if ($stathat_key) {
            stathat_ez_count($stathat_key, env('STATHAT_APP_NAME', 'votingapp') . ' - user register', 1);
        }

	}

}
