<?php namespace VotingApp\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'email', 'phone', 'birthdate', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Mutator to hash the password for safe storage.
     *
     * @var string
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
    }

    /**
     * Mutator to update the birthdate for the expected format.
     *
     * @var string
     */
    public function setBirthdateAttribute($birthdate)
    {
        $this->attributes['birthdate'] = date('Y-m-d', (strtotime($birthdate)));
    }

    /**
     * Mutator to update the phone number for the expected format.
     *
     * @var string
     */
    public function setPhoneAttribute($phone)
    {
        // Skip mutator if attribute is null.
        if (is_null($phone)) {
            return;
        }

        // Otherwise, remove all non-numeric characters.
        $this->attributes['phone'] = preg_replace('/[^0-9]/', '', $phone);
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
     * @param $input
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

        return false;
    }

    /**
     * Create new user, and fire corresponding event.
     */
    public static function createNewUser($attributes)
    {
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
        return $this->hasMany('VotingApp\Models\Vote');
    }

    /**
     * Check whether a user is allowed to vote.
     * User is allowed to vote once per 24 hours.
     * @return bool
     */
    public function canVote()
    {
        $voted = Vote::where('user_id', $this->id)->withinLastDay()->exists();
        return !$voted;
    }

    /**
     * Many-to-many relationship between users and roles.
     */
    public function roles()
    {
        return $this->belongsToMany('VotingApp\Models\Role');
    }

    /**
     * Check to see if User has a Role.
     * @return boolean
     */
    public function hasRole($name)
    {
        foreach ($this->roles as $role) {
            if ($role->name === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Assign a specific role to a User.
     * @param $role
     */
    public function assignRole($role)
    {
        $this->roles()->attach($role);
    }
}
