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

            'merge_vars' => [
                'FNAME' => $event->user->first_name,
                'CANDIDATE_NAME' => $event->candidate->name,
                'CANDIDATE_LINK' => route('candidates.show', $event->candidate->slug),
                'GENDER' => $event->candidate->gender,
            ],

            // This is always `en` because we don't translate Voting App & the
            // experience should be consistent between app and messaging.
            'user_language' => 'en',
        ];

        // Send fields for SMS communication if provided.
        if ($event->user->mobile) {
            $payload['mobile'] = $event->user->mobile;
            $payload['mobile_tags'] = [
                env('APP_NAME_TAG', 'votingapp'),
                $event->candidate->id,
                'GENDER_'.$event->candidate->gender,
            ];

            // Provide correct Mobile Opt In ID by country code
            $optInPaths = config('services.message_broker.opt_in_paths');
            $globalPath = config('services.message_broker.opt_in_paths.XG');
            $payload['mobile_opt_in_path_id'] = array_get($optInPaths, $event->user->country_code, $globalPath);
        }

        // Send fields for email communications if provided:
        if ($event->user->email) {
            $payload['email'] = $event->user->email;
            $payload['subscribed'] = 1;
            $payload['email_template'] = env('VOTE_TEMPLATE', 'mb-votingapp-vote').'-'.transactional_country_code($event->user->country_code);
            $payload['email_tags'] = [
                env('APP_NAME_TAG', 'votingapp'),
                $event->candidate->id,
                'GENDER_'.$event->candidate->gender,
            ];

            // Provide correct MailChimp list ID by country code
            $mailchimpLists = config('services.message_broker.lists');
            $globalList = config('services.message_broker.lists.XG');
            $payload['mailchimp_list_id'] = array_get($mailchimpLists, $event->user->country_code, $globalList);
        }

        $routingKey = env('VOTE_ROUTING_KEY', 'votingapp.event.vote');
        $this->broker->publish('vote', $payload, $routingKey);
    }
}
