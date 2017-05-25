<?php

namespace VotingApp\Events;

use VotingApp\Models\Vote;
use Illuminate\Queue\SerializesModels;

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
