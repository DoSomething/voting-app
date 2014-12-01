<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

  use UserTrait, RemindableTrait;

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
   * Mutator to update the birthdate for the expected format.
   *
   * @var string
   */
  public function setBirthdateAttribute($birthdate)
  {
    $this->attributes['birthdate'] = date('Y-m-d',(strtotime($birthdate)));
  }

  /**
   * Mutator to update the phone number for the expected format.
   *
   * @var string
   */
  public function setPhoneAttribute($phone)
  {
    // Skip mutator if attribute is null.
    if(is_null($phone)) return;

    // Otherwise, remove all non-numeric characters.
    $this->attributes['phone'] = preg_replace('/[^0-9]/','', $phone);
  }

  /**
   * Get birthdate formatted as a UNIX timestamp.
   */
  public function birthdate_timestamp()
  {
    return strtotime($this->attributes['birthdate']);
  }

  /**
   * Check if a user matching the given input exists.
   * @param $input Input
   * @return User|bool Matching user object or false if nonexistant.
   */
  public static function isCurrentUser($input)
  {
    $searchQuery = new User($input);

    $user = User::where('email', $searchQuery->email)
      ->where('phone', $searchQuery->phone)
      ->where('birthdate', $searchQuery->birthdate)
      ->first();

    if ($user) {
      return $user;
    }

    return FALSE;

  }

  /**
   * Create new user, and fire corresponding event.
   */
  public static function createNewUser($attributes)
  {
    Event::fire('user.create', [$user]);
    $user = new User($attributes);
    $user->country_code = get_country_code();
    $user->save();

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
