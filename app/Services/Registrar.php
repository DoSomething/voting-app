<?php

namespace VotingApp\Services;

use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Illuminate\Contracts\Validation\ValidationException;
use VotingApp\Models\User;
use VotingApp\Events\UserRegistered;

class Registrar implements RegistrarContract
{
    /**
     * The validation factory.
     *
     * @var \Illuminate\Validation\Factory
     */
    protected $validation;

    /**
     * The Northstar API client.
     *
     * @var Northstar
     */
    protected $northstar;

    public function __construct(Northstar $northstar)
    {
        $this->validation = app('validator');
        $this->northstar = $northstar;
    }

    /**
     * Get the validation rules to use for an registration or
     * authorization request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'first_name' => ['required'],
            'birthdate' => ['required', 'localized_date', 'before:today'],
            'email' => ['required', 'email'],
        ];

        if (should_collect_phone()) {
            $rules['phone'] = ['phone:'.get_country_code().',mobile'];
        }

        return $rules;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return $this->validation->make($data, $this->rules());
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
        if (! $user) {
            $user = new User($data);

            $validator = $this->validation->make($user->toArray(), [
                'phone' => 'unique:users',
                'email' => 'unique:users',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user->country_code = get_country_code();
            $user->northstar_id = $this->northstar->register($user);

            $user->save();

            event(new UserRegistered($user));
        }

        return $user;
    }
}
