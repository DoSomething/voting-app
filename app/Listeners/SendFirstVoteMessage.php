<?php

namespace VotingApp\Listeners;

use VotingApp\Events\UserCastFirstVote;
use VotingApp\Services\MessageBroker;

class SendFirstVoteMessage
{
    /**
     * The Message Broker handles sending messages.
     *
     * @var MessageBroker
     */
    protected $broker;

    public function __construct(MessageBroker $broker)
    {
        $this->broker = $broker;
    }

    /**
     * Handle the event.
     *
     * @param  UserCastFirstVote $event
     * @return void
     */
    public function handle(UserCastFirstVote $event)
    {
        $payload = [
            'first_name' => $event->user->first_name,
            'birthdate_timestamp' => strtotime($event->user->birthdate), // Message Broker expects UNIX timestamp
            'user_country' => $event->user->country_code,
            'candidate_id' => $event->candidate->id,
            'candidate_name' => $event->candidate->name,

            // This is always `en` because we don't translate Voting App & the
            // experience should be consistent between app and messaging.
            'user_language' => 'en',
        ];

        if ($event->user->phone) {
            // Send fields for SMS communication if provided.
            $payload['mobile'] = $event->user->phone;
            $payload['mobile_tags'] = [
                env('APP_NAME_TAG', 'votingapp'),
                $event->candidate->id,
                'GENDER_'.$event->candidate->gender,
            ];
        } else {
            // Or, send fields for email communications.
            $payload['email'] = $event->user->email;
            $payload['subscribed'] = 1;
            $payload['email_template'] = env('VOTE_TEMPLATE', 'mb-votingapp-vote').'-'.normalize_country_code($event->user->country_code);
            $payload['email_tags'] = [
                env('APP_NAME_TAG', 'votingapp'),
                $event->candidate->id,
                'GENDER_'.$event->candidate->gender,
            ];
            $payload['merge_vars'] = [
                'FNAME' => $event->user->first_name,
                'CANDIDATE_NAME' => $event->candidate->name,
                'CANDIDATE_LINK' => route('candidates.show', $event->candidate->slug),
                'GENDER' => $event->candidate->gender,
            ];
        }

        // Send Mobile Commons opt-in path for US users, and MGage ID for international users.
        if($event->user->country_code === 'US') {
            $payload['opt_in_path_id'] = env('MC_OPT_IN_PATH');
        } else {
            $payload['opt_in_path_id'] = env('MGAGE_ID');
        }

        $routingKey = env('VOTE_ROUTING_KEY', 'votingapp.event.vote');
        $this->broker->publish('vote', $payload, $routingKey);
    }
}
