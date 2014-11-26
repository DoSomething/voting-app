<?php

use Laracasts\Validation\FormValidator;

class UserRegistrationValidator extends FormValidator {

  /**
   * Validate uniqueness before creating a new user.
   */
  protected $rules = [
    'phone' => 'unique:users',
    'email' => 'unique:users',
  ];

  protected $messages = [
    'phone.unique' => 'That phone number is already registered with a different user. Check your other information and try again.',
    'email.unique' => 'That email is already registered with a different user. Check your other information and try again.',
  ];

  /**
   * Prepare user object so mutators can run before validating.
   *
   * @param array $formData
   * @return mixed
   */
  public function validate($formData)
  {
    $user = new User($formData);

    // Send the mutated attributes back to the default validator method.
    parent::validate($user['attributes']);
  }

}
