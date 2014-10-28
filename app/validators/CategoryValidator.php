<?php

use Laracasts\Validation\FormValidator;

class CategoryValidator extends FormValidator {

  /**
   * Validation rules for creating the model.
   *
   * @var array
   */
  public $rules = [
    'name' => 'required',
  ];

}
