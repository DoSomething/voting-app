<?php namespace VotingApp\Handlers\Events;

use VotingApp\Events\UserRegistered;
use MessageBroker;

class SendWelcomeMessage
{

    /**
     * Handle the event.
     *
     * @param  UserRegistered $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        // Don't send messages locally.
        if (app()->environment('local', 'testing')) {
            return;
        }

        // Configure the message broker connection
        $credentials = config('services.message_broker.credentials');
        $config = config('services.message_broker.config');
        $config['routingKey'] = env('REGISTER_ROUTING_KEY', 'votingapp.user.registration');
        $broker = new MessageBroker($credentials, $config);

        // Sign user up for transaction messages.
        $payload = [
            // User information
            'first_name' => $event->user->first_name,
            'email' => $event->user->email,
            'mobile' => $event->user->phone,
            'birthdate_timestamp' => strtotime($event->user->birthdate), // Message Broker expects UNIX timestamp
            'country_code' => $event->user->country_code,

            // Request specific information
            'activity' => env('REGISTER_ACTIVITY', 'votingapp_signup'),
            'application_id' => 201,
            'activity_timestamp' => time(),
            'email_template' => env('REGISTER_TEMPLATE', 'mb-votingapp-signup'),
            'email_tags' => [
                0 => env('REGISTER_EMAIL_TAG', 'votingapp_signup'),
            ],
            'mailchimp_grouping_id' => env('MAILCHIMP_GROUP_ID'),
            'mailchimp_group_name' => env('MAILCHIMP_GROUP_NAME'),
            'mc_opt_in_path_id' => env('MC_OPT_IN_PATH'),
            'merge_vars' => [
                'FNAME' => $event->user->first_name
            ],
            'user_registration_source' => env('REGISTER_MB_SOURCE', 'votingapp')
        ];

        $payload = serialize($payload);
        $broker->publishMessage($payload);
    }

}
