<?php

namespace VotingApp\Http\Requests;

use Illuminate\Contracts\Auth\Guard;
use VotingApp\Models\Candidate;
use VotingApp\Services\Registrar;

class VoteRequest extends Request
{
    /**
     * The authorization service.
     * @var Guard
     */
    protected $guard;

    /**
     * The registration service.
     * @var Registrar
     */
    protected $registrar;

    public function __construct(Guard $guard, Registrar $registrar)
    {
        $this->guard = $guard;
        $this->registrar = $registrar;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        // If user is a guest, make sure they are able to register/login.
        if ($this->guard->guest()) {
            $rules = $this->registrar->rules();
        }

        $rules['candidate_id'] = ['required'];

        return $rules;
    }

    /**
     * Set custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'phone.phone' => 'That doesn\'t look like a valid phone number.',
        ];
    }

    /**
     * Get the URL to redirect to on a validation error.
     *
     * @return string
     */
    protected function getRedirectUrl()
    {
        if ($this->has('candidate_id')) {
            $slug = Candidate::where('id', $this->get('candidate_id'))->first()->slug;

            return route('candidates.show', [$slug]);
        }

        return parent::getRedirectUrl();
    }
}
