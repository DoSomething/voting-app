<?php

use Illuminate\Html\FormBuilder;

FormBuilder::macro('error', function($field, $errors)
{
  return $errors->first($field, '<span class="validation error">:message</span>');
});
