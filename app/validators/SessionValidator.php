<?php

use Laracasts\Validation\FormValidator;

class SessionValidator extends FormValidator {

  /**
   * Validation rules for logging in.
   *
   * @var array
   */
  protected $rules = [
   // @TODO: require either email or phone number
    'first_name' => 'required',
    'email' => 'email',
    'birthdate' => 'required|date'
    // 'password' => 'required'
  ];

}
