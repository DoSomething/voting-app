<?php

use \Carbon\Carbon;

class WriteIn extends Eloquent {

  /**
   * The attributes which may be mass-assigned.
   *
   * @var array
   */
  protected $fillable = ['candidate_name', 'description'];

  /**
   * A vote belongs to a User.
   */
  public function user()
  {
    return $this->belongsTo('User');
  }
}
