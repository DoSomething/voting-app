<?php

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Page extends \Eloquent implements SluggableInterface {

  use SluggableTrait;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'pages';

  /**
   * The attributes which may be mass-assigned.
   *
   * @var array
   */
  protected $fillable = [
    'title', 'content'
  ];

  /**
   * Configuration for generating slug with Eloquent-Sluggable.
   *
   * @var array
   */
  protected $sluggable = [
    'build_from' => 'title',
    'save_to' => 'slug'
  ];

  public function setContentAttribute($content)
  {
    $this->attributes['content'] = $content;
    $this->attributes['content_html'] = Parsedown::instance()->text($content);
  }

}
