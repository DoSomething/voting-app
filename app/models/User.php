<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

  use UserTrait, RemindableTrait;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes which may be mass-assigned.
   *
   * @var array
   */
  protected $fillable = ['email', 'password'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = array('password', 'remember_token');

  /**
   * Mutator to hash the password for safe storage.
   *
   * @var string
   */
  public function setPasswordAttribute($password)
  {
    $this->attributes['password'] = Hash::make($password);
  }

  /**
   * A user has many votes.
   */
  public function votes()
  {
    return $this->hasMany('Vote');
  }

  /**
   * Check whether a user is allowed to vote on a given candidate.
   * User is allowed to vote if they haven't voted in this category in the last 24 hours.
   */
  public function canVote(Candidate $candidate)
  {
    $existing_vote = Vote::whereUserId($this->id)
      ->inCategory($candidate->category)
      ->withinLastDay()
      ->first();

    return is_null($existing_vote);
  }

}
