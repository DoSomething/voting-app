<?php

use Laracasts\Validation\FormValidator;

class SessionValidator extends FormValidator {

  /**
   * Validation rules for logging in.
   *
   * @var array
   */
  protected $rules = [
    'email' => 'required|email',
    'password' => 'required'
  ];

}
