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
   * Many-to-many relationship between Users and Candidates.
   */
  public function votes()
  {
    return $this->belongsToMany('Candidate', 'votes')->withTimestamps();
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
