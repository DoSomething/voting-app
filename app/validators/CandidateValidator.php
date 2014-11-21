<?php

use Laracasts\Validation\FormValidator;

class CandidateValidator extends FormValidator {

  /**
   * Validation rules for creating the model.
   *
   * @var array
   */
  protected $rules = [
    'name' => 'required',
    'photo_source' => 'url'
  ];

}
