<?php namespace VotingApp\Services;

use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use VotingApp\Models\User;
use VotingApp\Events\UserRegistered;
use VotingApp\Services\Northstar;

class Registrar implements RegistrarContract
{

    /**
     * The validation factory.
     *
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;

    /**
     * The Northstar API client.
     *
     * @var Northstar $northstar
     */
    protected $northstar;

    public function __construct(Northstar $northstar)
    {
        $this->validator = app('validator');
        $this->northstar = $northstar;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return $this->validator->make($data, [
            'phone' => 'unique:users',
            'email' => 'unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    public function create(array $data)
    {
        $user = User::isCurrentUser($data);

        // If user doesn't exist, attempt to create.
        if (!$user) {
            $this->validator($data);

            $user = new User($data);
            $user->country_code = get_country_code();
            $user->save();

            $user->northstar_id = $this->northstar->register($user);
            $user->save();

            event(new UserRegistered($user));
        }

        return $user;
    }
}
