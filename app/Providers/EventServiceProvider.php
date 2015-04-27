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
        'App\Events\UserRegistered' => [
            'App\Handlers\Events\SendWelcomeEmail',
            'App\Handlers\Events\UpdateRegistrationStats',
        ],
        'App\Events\UserCastVote' => [
            'App\Handlers\Events\UpdateVotingStats',
        ],
        'App\Events\UserCastFirstVote' => [
            'App\Handlers\Events\SendFirstVoteEmail',
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
    }
}
