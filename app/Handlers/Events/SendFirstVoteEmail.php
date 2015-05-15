<?php namespace VotingApp\Handlers\Events;

use VotingApp\Events\UserCastFirstVote;
use MessageBroker;

class SendFirstVoteEmail
{

    /**
     * Handle the event.
     *
     * @param  UserCastFirstVote $event
     * @return void
     */
    public function handle(UserCastFirstVote $event)
    {
        // Don't send messages locally.
        if (app()->environment('local')) {
            return;
        }

        // Configure the message broker connection
        $credentials = Config::get('services.message_broker.credentials');
        $config = Config::get('services.message_broker.config');
        $config['routingKey'] = env('VOTE_ROUTING_KEY', 'votingapp.event.vote');
        $broker = new MessageBroker($credentials, $config);

        // Sign user up for transaction messages.
        $payload = [
            // User information
            'first_name' => $event->first_name,
            'email' => $event->email,
            'mobile' => $event->phone,
            'birthdate_timestamp' => $event->birthdate, // Message Broker expects UNIX timestamp
            'country_code' => $event->country_code,

            // Candidate information.
            'candidate_id' => $event->candidate_id,
            'candidate_name' => $event->candidate_name,

            // Request specific information
            'activity' => env('VOTE_ACTIVITY', 'votingapp_vote'),
            'application_id' => 201,
            'activity_timestamp' => time(),
            'email_template' => env('VOTE_TEMPLATE', 'mb-votingapp-vote'),
            'email_tags' => [
                0 => env('VOTE_EMAIL_TAG', 'votingapp_signup'),
            ],
            'mailchimp_grouping_id' => env('MAILCHIMP_GROUP_ID'),
            'mailchimp_group_name' => env('MAILCHIMP_GROUP_NAME'),
            'mc_opt_in_path_id' => env('MC_OPT_IN_PATH'),
            'merge_vars' => [
                'FNAME' => $event->first_name
            ]
        ];

        $payload = serialize($payload);
        $broker->publishMessage($payload);
    }

}
