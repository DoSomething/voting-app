<?php

use Laracasts\Validation\FormValidator;

class UserSessionValidator extends FormValidator {

  /**
   * Validation rules for logging in.
   *
   * The phone number regex is taken from the DoSomething repo
   * https://github.com/DoSomething/dosomething/blob/ca1a1233240b0431da9909ee8e3cdc61d2440d20/lib/modules/dosomething/dosomething_user/dosomething_user.module#L179
   * @var array
   */
  protected $rules = [
    'first_name' => 'required',
    'phone' => 'required_without:email|unique:users|regex:#^(?:\+?([0-9]{1,3})([\-\s\.]{1})?)?\(?([0-9]{3})\)?(?:[\-\s\.]{1})?([0-9]{3})(?:[\-\s\.]{1})?([0-9]{4})#',
    'email' => 'required_without:phone|unique:users|email',
    'birthdate' => 'required|date',
  ];

  protected $messages = [
    'first_name.required' => 'What\'s your name?!',
    'phone.required_without' => 'Give us your digits!',
    'phone.regex' => 'That doesn\'t look like a real phone number!',
    'email.required_without' => 'We need your email',
    'email.email' => 'We need a valid email',
    'birthdate.required' => 'When were you born?',
    'birthdate.date' => 'Enter your birthday MM/DD/YYYY!',
  ];

}
