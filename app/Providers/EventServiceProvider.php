<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use MessageBroker;
use Event;
use App;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'event.name' => [
            'EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        // @TODO These should be in their own Event classes in App\Events

        // An event listener that handles user votes.
        Event::listen('first.vote', function ($candidate, $user) {
            // Don't send messages locally.
            if (App::environment('local')) {
                return;
            }
            // Sign user up for transaction messages.
            $credentials = Config::get('services.message_broker.credentials');
            $config = Config::get('services.message_broker.config');
            $config['routingKey'] = env('VOTE_ROUTING_KEY', 'votingapp.event.vote');

            $mb = new MessageBroker($credentials, $config);

            $payload = [
                // User information
                'first_name' => $user->first_name,
                'email' => $user->email,
                'mobile' => $user->phone,
                'birthdate_timestamp' => $user->birthdate_timestamp(), // Message Broker expects UNIX timestamp
                'country_code' => $user->country_code,

                // Candidate information.
                'candidate_id' => $candidate->id,
                'candidate_name' => $candidate->name,

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
                    'FNAME' => $user->first_name
                ]
            ];

            $payload = serialize($payload);
            $mb->publishMessage($payload);

            if (extension_loaded('newrelic')) {
                newrelic_add_custom_parameter("user_birthdate", $user->birthdate_timestamp());
            }


        });

        Event::listen('user.create', function ($user) {
            // Don't send messages locally.
            if (App::environment('local')) {
                return;
            }

            //  // Log this event to stathat.
            $stathat_key = Config::get('services.stathat.key');
            if ($stathat_key) {
                stathat_ez_count($stathat_key, env('STATHAT_APP_NAME', 'votingapp') . ' - user register', 1);
            }

            // Sign user up for transaction messages.
            $credentials = Config::get('services.message_broker.credentials');
            $config = Config::get('services.message_broker.config');
            $config['routingKey'] = env('REGISTER_ROUTING_KEY', 'votingapp.user.registration');

            $mb = new MessageBroker($credentials, $config);

            $payload = [
                // User information
                'first_name' => $user->first_name,
                'email' => $user->email,
                'mobile' => $user->phone,
                'birthdate_timestamp' => $user->birthdate_timestamp(), // Message Broker expects UNIX timestamp
                'country_code' => $user->country_code,

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
                    'FNAME' => $user->first_name
                ],
                'user_registration_source' => env('REGISTER_MB_SOURCE', 'votingapp')
            ];

            $payload = serialize($payload);
            $mb->publishMessage($payload);

        });

        Event::listen('user.vote', function () {
            if (App::environment('local')) {
                return;
            }
            // Log this event to stathat.
            $stathat_key = Config::get('services.stathat.key');
            if ($stathat_key) {
                stathat_ez_count($stathat_key, env('STATHAT_APP_NAME', 'votingapp') . ' - vote', 1);
            }
        });
    }
}
