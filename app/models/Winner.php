<?php

class Winner extends Eloquent {

  /**
   * The attributes which may be mass-assigned.
   *
   * @var array
   */
  protected $fillable = [
    'rank', 'description'
  ];

  // No timestamps on the winners table.
  public $timestamps = false;

  /**
   * A winner belongs to a candidate.
   */
  public function candidate()
  {
    return $this->belongsTo('Candidate');
  }

}
