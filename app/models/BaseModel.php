<?php

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class BaseModel extends Eloquent implements SluggableInterface {
  use SluggableTrait;

  protected $errors;

  public static function boot()
  {
    parent::boot();

    // Validate model on save
    static::saving(function($model) {
      $model->sluggify();
      return $model->validate();
    });
  }

  public function validate()
  {
    $validation = Validator::make($this->attributes, static::$rules);

    if($validation->passes())
      return true;

    $this->errors = $validation->messages();
    return false;
  }

  public function getErrors()
  {
    return $this->errors;
  }
}
