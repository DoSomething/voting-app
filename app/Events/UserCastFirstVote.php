<?php

namespace VotingApp\Events;

use Illuminate\Queue\SerializesModels;
use VotingApp\Models\Vote;

class UserCastFirstVote extends Event
{
    use SerializesModels;

    public $candidate;

    public $user;

    /**
     * Create a new event instance.
     * @param Vote $vote
     */
    public function __construct(Vote $vote)
    {
        $this->candidate = $vote->candidate;
        $this->user = $vote->user;
    }
}
