<?php

use Laracasts\Validation\FormValidator;

class PageValidator extends FormValidator {

  /**
   * Validation rules for creating the model.
   *
   * @var array
   */
  protected $rules = [
    'title' => 'required',
    'content' => 'required'
  ];

}
