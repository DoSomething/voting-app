<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;

class User extends Eloquent implements UserInterface{

  use UserTrait;

  /**
   * The attributes which may be mass-assigned.
   *
   * @var array
   */
  protected $fillable = ['first_name', 'email', 'phone', 'birthdate', 'password'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = ['password'];

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
   * Mutator to update the birthdate for the expexted format.
   *
   * @var string
   */
  public function setBirthdateAttribute($birthdate)
  {
    $this->attributes['birthdate'] = date('Y-m-d',(strtotime($birthdate)));
  }
      /**
   * Mutator to update the birthdate for the expexted format.
   *
   * @var string
   */
  public function getBirthdateAttribute($birthdate)
  {
    return date('m-d-Y',(strtotime($birthdate)));
  }

  public static function isCurrentUser($input)
  {
    $birthdate = date('Y-m-d',(strtotime($input['birthdate'])));

    $user = User::where('email', $input['email'])
                ->where('phone', $input['phone'])
                ->first();

    if ($user && $user->birthdate == $birthdate) {
      return $user;
    } elseif ($user->birthdate != $birthdate) {
      return $user->email;
    }
    return FALSE;

  }

  public static function createNewUser($input)
  {
    $user = User::create([
                'first_name' => $input['first_name'],
                'email' => $input['email'],
                'birthdate' => $input['birthdate'],
                ]);
    return $user;
  }

  /**
   * A user has many votes.
   */
  public function votes()
  {
    return $this->hasMany('Vote');
  }

  /**
   * A user has many write-in votes.
   */
  public function writeIn()
  {
    return $this->hasMany('WriteIn');
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

  /**
   * Check whether a user is allowed to vote on a given candidate.
   * User is allowed to vote if they haven't voted in this category in the last 24 hours.
   */
  public function canVoteInCategory(Category $category)
  {
    $existing_vote = Vote::whereUserId($this->id)
      ->inCategory($category)
      ->withinLastDay()
      ->first();

    return is_null($existing_vote);
  }

  /**
   * Many-to-many relationship between users and roles.
   */
  public function roles()
  {
    return $this->belongsToMany('Role');
  }

  /**
   * Check to see if User has a Role.
   * @return boolean
   */
  public function hasRole($name)
  {
    foreach ($this->roles as $role) {
      if ($role->name === $name)
        return true;
    }

    return false;
  }
  /**
   * Assign a specific role to a User.
   */
  public function assignRole($role)
  {
    return $this->roles()->attach($role);
  }



}
