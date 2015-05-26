<?php namespace VotingApp\Events;

use Illuminate\Queue\SerializesModels;
use VotingApp\Models\User;

class UserRegistered extends Event
{

    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

}
