<?php

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Laracasts\Presenter\PresentableTrait;

class Candidate extends Eloquent implements SluggableInterface {

  use PresentableTrait;
  use SluggableTrait;

  /**
   * The presenter class for view logic.
   *
   * @var string
   */
  protected $presenter = 'CandidatePresenter';

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'candidates';

  /**
   * The attributes which may be mass-assigned.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'description', 'category_id'
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

  public function category()
  {
    return $this->belongsTo('Category');
  }

  public function voters()
  {
    return $this->belongsToMany('User', 'votes');
  }

  public function savePhoto($photo)
  {
      $filename = $this->sluggify()->slug . '.jpg';

      // Save full-size image
      $photo->encode('jpg', 75)->save(public_path('images') . '/' . $filename);

      // Save thumbnail
      $photo->encode('jpg', 75)->fit(400)
        ->save(public_path('images') . '/' . 'thumb-' . $filename);

      $this->attributes['photo'] = $filename;
  }

  public function thumbnail()
  {
    if($this->photo) {
      return "/images/thumb-" . $this->photo;
    } else {
      return "/placeholder.png";
    }
  }
}
