<?php namespace VotingApp\Services;

use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use VotingApp\Models\User;
use VotingApp\Events\UserRegistered;

class Registrar implements RegistrarContract
{

    /**
     * The validation factory.
     *
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;

    public function __construct()
    {
        $this->validator = app('validator');
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

            event(new UserRegistered($user));
        }

        return $user;
    }
}
