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

  /**
   * Inverse has-many relationship to Categories.
   */
  public function category()
  {
    return $this->belongsTo('Category');
  }

  /**
   * Many-to-many relationship between Users and Candidates.
   */
  public function votes()
  {
    return $this->belongsToMany('User', 'votes')->withTimestamps();
  }

  /**
   * Save a photo, generate thumbnail, and attach it to the model.
   *
   * @param mixed $photo Input to Intervention\Image::make (such as Input::file)
   * @see http://image.intervention.io/api/make
   */
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

}
