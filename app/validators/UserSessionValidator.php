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
    'email' => 'required|email',
    'birthdate' => 'required|date'
  ];

}
