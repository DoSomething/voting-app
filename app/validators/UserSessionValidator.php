<?php

use Laracasts\Validation\FormValidator;

class UserSessionValidator extends FormValidator {

  /**
   * Validation rules for logging in.
   *
   * @var array
   */
  protected $rules = [
    'first_name' => 'required',
    'phone' => 'required_without:email',
    'email' => 'required_without:phone|email',
    'birthdate' => 'required|date',
  ];

}
