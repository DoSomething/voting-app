<?php namespace VotingApp\Handlers\Events;

use VotingApp\Events\UserCastFirstVote;
use MessageBroker;

class SendFirstVoteMessage
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
        if (app()->environment('local', 'testing')) {
            return;
        }

        // Configure the message broker connection
        $credentials = config('services.message_broker.credentials');
        $config = config('services.message_broker.config');
        $config['routingKey'] = env('VOTE_ROUTING_KEY', 'votingapp.event.vote');
        $broker = new MessageBroker($credentials, $config);

        $payload = [
            // User information
            'birthdate_timestamp' => strtotime($event->user->birthdate), // Message Broker expects UNIX timestamp
            'country_code' => $event->user->country_code,

            // Candidate information.
            'candidate_id' => $event->candidate->id,
            'candidate_name' => $event->candidate->name,

            // Request specific information
            'activity' => env('VOTE_ACTIVITY', 'vote'),
            'application_id' => env('MESSAGE_BROKER_APPLICATION_ID'),
            'activity_timestamp' => time(),
        ];

        // Send fields for domestic users
        if($event->user->country_code === 'US') {
            $payload['mobile'] = $event->user->phone;
            $payload['mc_opt_in_path_id'] = env('MC_OPT_IN_PATH');
            $payload['mobile_tags'] = [
                env('APP_NAME_TAG', 'votingapp'),
                $event->candidate->id
            ];
        }

        // Send fields for international users
        if($event->user->country_code !== 'US') {
            $payload['email'] = $event->user->email;
            $payload['subscribed'] = 1;
            $payload['mailchimp_grouping_id'] = env('MAILCHIMP_GROUP_ID');
            $payload['mailchimp_group_name'] = env('MAILCHIMP_GROUP_NAME');
            $payload['mailchimp_list_id'] = env('MAILCHIMP_LIST_ID');
            $payload['email_template'] = env('VOTE_TEMPLATE', 'mb-votingapp-vote');
            $payload['email_tags'] = [
                env('APP_NAME_TAG', 'votingapp'),
                $event->candidate->id
            ];
            $payload['merge_vars'] = [
                'FNAME' => $event->user->first_name,
                'CANDIDATE_NAME' => $event->candidate->name
            ];
        }

        $payload = serialize($payload);
        $broker->publishMessage($payload);
    }

}
