<?php

namespace VotingApp\Services;

use VotingApp\Models\User;
use VotingApp\Events\UserRegistered;
use GuzzleHttp\Exception\ConnectException;
use DoSomething\Northstar\Exceptions\APIException;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract
{
    /**
     * The validation factory.
     *
     * @var \Illuminate\Validation\Factory
     */
    protected $validation;

    public function __construct()
    {
        $this->validation = app('validator');
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
            $rules['mobile'] = ['phone:'.get_country_code()];
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
                'mobile' => 'unique:users',
                'email' => 'unique:users',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user->country_code = get_country_code();

            // Create user in Northstar
            $payload = $user->toArray();
            $payload['source'] = 'voting_app';

            try {
                $northstar_user = gateway('northstar')->createUser($payload);
                $user->northstar_id = $northstar_user->id;
            } catch (ValidationException $e) {
                // If this conflicts in Northstar, mark null rather than
                // bothering the user with the specific issue & preventing the vote.
                $user->northstar_id = null;
            } catch (APIException $e) {
                logger('northstar exception', ['error' => $e->getMessage()]);
                $user->northstar_id = null;
            } catch (ConnectException $e) {
                $user->northstar_id = null;
            }

            $user->save();

            event(new UserRegistered($user));
        }

        return $user;
    }
}
