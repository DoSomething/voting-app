<?php namespace VotingApp\Events;

use Illuminate\Queue\SerializesModels;
use VotingApp\Models\User;

class UserRegistered extends Event
{

    use SerializesModels;

    public $first_name;

    public $email;

    public $phone;

    public $birthdate;

    public $country_code;

    /**
     * Create a new event instance.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->first_name = $user->first_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->birthdate = $user->birthdate_timestamp();
        $this->country_code = $user->country_code;
    }

}
