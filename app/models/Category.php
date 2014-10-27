<?php

class Category extends BaseModel {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'categories';

  protected $fillable = [
    'name'
  ];

  public static $rules = [
    'name' => 'required',
  ];

  protected $sluggable = [
    'build_from' => 'name',
    'save_to' => 'slug'
  ];

  public function candidates()
  {
    return $this->hasMany('Candidate');
  }
}
