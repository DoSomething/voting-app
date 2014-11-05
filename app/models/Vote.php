<?php

use \Carbon\Carbon;

class Vote extends Eloquent {

  /**
   * The attributes which may be mass-assigned.
   *
   * @var array
   */
  protected $fillable = ['candidate_id', 'user_id'];

  /**
   * A vote belongs to a User.
   */
  public function user()
  {
    return $this->belongsTo('User');
  }

  /**
   * A vote belongs to a Candidate.
   */
  public function candidate()
  {
    return $this->belongsTo('Candidate');
  }

  /**
   * Scope a query to votes cast within the last 24 hours.
   */
  public function scopeWithinLastDay($query)
  {
    return $query->where('votes.created_at', '>', Carbon::now()->subDay()->toDateTimeString());
  }

  /**
   * Scope a query to votes within a given category.
   */
  public function scopeInCategory($query, Category $category)
  {
    return $query->join('candidates', 'candidate_id', '=', 'candidates.id')
      ->where('candidates.category_id', $category->id);
  }

}
