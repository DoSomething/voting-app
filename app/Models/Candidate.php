<?php

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Candidate extends Model implements SluggableInterface
{

  use SluggableTrait;

  /**
   * The attributes which may be mass-assigned.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'description', 'category_id', 'twitter', 'photo_source'
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

    protected $appends = array('share_name');

  /**
   * Inverse has-many relationship to Categories.
   */
  public function category()
  {
      return $this->belongsTo('Category');
  }

  /**
   * A candidate has many votes.
   */
  public function votes()
  {
      return $this->hasMany('Vote');
  }

  /**
   * A candidate may be a winner.
   */
  public function winner()
  {
      return $this->hasOne('Winner');
  }

  /**
   * @return string
   */
  public function thumbnail()
  {
      if ($this->photo) {
          return "/thumbnails/thumb-" . $this->photo;
      } else {
          return "/placeholder.png";
      }
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
    $photo->encode('jpg', 75)->save(public_path('thumbnails') . '/' . $filename);

    // Save thumbnail
    $photo->encode('jpg', 75)->fit(400)
      ->save(public_path('thumbnails') . '/' . 'thumb-' . $filename);

      $this->attributes['photo'] = $filename;
  }

  /**
   * Custom share name attribute
   *
   * @return string twitter handle, or celeb name
   * @see $appends array
   */
  public function getShareNameAttribute()
  {
      return (!empty($this->twitter)) ? $this->twitter : $this->name;
  }
}
