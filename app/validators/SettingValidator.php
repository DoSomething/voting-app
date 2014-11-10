<?php

use Laracasts\Validation\FormValidator;

class SettingValidator extends FormValidator {

  /**
   * Validation rules for creating the model.
   *
   * @var array
   */
  protected $rules = [
    'value' => 'required'
  ];

}
