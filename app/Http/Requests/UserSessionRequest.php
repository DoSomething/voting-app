<?php namespace VotingApp\Http\Requests;

use VotingApp\Models\Candidate;
use Auth;

class UserSessionRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'first_name' => 'required',
            'phone' => 'required_without:email|regex:/^((1)?([\-\s\.]{1})?)?\(?([0-9]{3})\)?(?:[\-\s\.]{1})?([0-9]{3})(?:[\-\s\.]{1})?([0-9]{4})/',
            'email' => 'required_without:phone|email',
            'birthdate' => 'required|date|before:today',
        ];

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
            'first_name.required' => 'What\'s your name?!',
            'phone.required_without' => 'Give us your digits!',
            'phone.regex' => 'That doesn\'t look like a real phone number!',
            'email.required_without' => 'We need your email',
            'email.email' => 'We need a valid email',
            'birthdate.required' => 'When were you born?',
            'birthdate.date' => 'Enter your birthday MM/DD/YYYY!',
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
            $slug = Candidate::whereId($this->get('candidate_id'))->first()->slug;
            return route('candidates.show', [$slug]);
        }

        return parent::getRedirectUrl();
    }
}
