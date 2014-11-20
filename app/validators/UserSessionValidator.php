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
    'phone' => 'required_without:email|regex:#^(?:\+?([0-9]{1,3})([\-\s\.]{1})?)?\(?([0-9]{3})\)?(?:[\-\s\.]{1})?([0-9]{3})(?:[\-\s\.]{1})?([0-9]{4})#',
    'email' => 'required_without:phone|email',
    'birthdate' => 'required|date',
  ];

}
