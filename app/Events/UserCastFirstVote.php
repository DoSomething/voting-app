<?php namespace VotingApp\Events;

use Illuminate\Queue\SerializesModels;
use VotingApp\Models\Vote;

class UserCastFirstVote extends Event
{

    use SerializesModels;

    public $first_name;

    public $email;

    public $phone;

    public $birthdate;

    public $country_code;

    public $candidate_id;

    public $candidate_name;

    /**
     * Create a new event instance.
     * @param Vote $vote
     */
    public function __construct(Vote $vote)
    {
        $this->first_name = $vote->user->first_name;
        $this->email = $vote->user->email;
        $this->phone = $vote->user->phone;
        $this->birthdate = $vote->user->birthdate_timestamp();
        $this->country_code = $vote->user->country_code;

        $this->candidate_id = $vote->candidate->id;
        $this->candidate_name = $vote->candidate->name;
    }

}
