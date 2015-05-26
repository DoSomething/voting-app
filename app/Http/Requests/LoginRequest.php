<?php namespace VotingApp\Http\Requests;

use VotingApp\Models\Candidate;
use Auth;

class LoginRequest extends Request
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
            'birthdate' => 'required|date|before:today',
        ];

        if(is_international_session()) {
            $rules['email'] = 'required|email';
        }

        if(should_collect_international_phone()) {
            $rules['phone'] = 'phone';
        }

        if(is_domestic_session()) {
            $rules['phone'] = 'required|phone';
        }

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
            'phone.phone' => 'That doesn\'t look like a real phone number!',
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
