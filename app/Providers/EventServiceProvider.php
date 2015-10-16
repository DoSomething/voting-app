<?php

namespace VotingApp\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'VotingApp\Events\UserRegistered' => [
            'VotingApp\Handlers\Events\UpdateRegistrationStats',
        ],
        'VotingApp\Events\UserCastVote' => [
            'VotingApp\Handlers\Events\UpdateVotingStats',
        ],
        'VotingApp\Events\UserCastFirstVote' => [
            'VotingApp\Handlers\Events\SendFirstVoteMessage',
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
