<?php

use Laracasts\Validation\FormValidator;

class UserValidator extends FormValidator {

  /**
   * Validation rules for logging in.
   *
   * @var array
   */
  protected $rules = [
    'email' => 'required|email|unique:users',
    'password' => 'required|confirmed'
  ];

}
