<?php namespace VotingApp\Events;

use VotingApp\Events\Event;

use Illuminate\Queue\SerializesModels;

class UserCastVote extends Event
{

    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        //
    }

}
