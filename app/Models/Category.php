<?php

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Category extends Model implements SluggableInterface
{

  use SluggableTrait;

  public static function boot()
  {
    parent::boot();

    Category::saved(function ($category) {
      // Clear categories cache whenever model is updated
      \Cache::forget('categories');
    });

  }

  /**
   * The attributes which may be mass-assigned.
   *
   * @var array
   */
  protected $fillable = [
    'name'
  ];

  /**
   * Configuration for generating slug with Eloquent-Sluggable.
   *
   * @var array
   */
  protected $sluggable = [
    'build_from' => 'name',
    'save_to' => 'slug'
  ];

  public function candidates()
  {
    return $this->hasMany('Candidate')->orderBy('name', 'asc');
  }

}
