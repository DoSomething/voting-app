<?php

namespace VotingApp\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use VotingApp\LocalizedDate;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

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
    protected $fillable = ['first_name', 'email', 'mobile', 'birthdate', 'northstar_id'];

    /**
     * Mutator to update the birthdate for the expected format.
     *
     * @var string
     */
    public function setBirthdateAttribute($birthdate)
    {
        $formatted = LocalizedDate::parse($birthdate)->format('Y-m-d');
        $this->attributes['birthdate'] = $formatted;
    }

    /**
     * Mutator to update the phone number for the expected format.
     *
     * @var string
     */
    public function setMobileAttribute($mobile)
    {
        // Skip mutator if attribute is null.
        if (empty($mobile)) {
            return;
        }

        // Otherwise, remove all non-numeric characters.
        $this->attributes['mobile'] = preg_replace('/[^0-9]/', '', $mobile);
    }

    /**
     * Check if a user matching the given input exists.
     * @param $input
     * @return User|bool Matching user object or false if nonexistant.
     */
    public static function isCurrentUser($input)
    {
        $searchQuery = new self($input);

        $user = self::where('email', $searchQuery->email)
            ->where('mobile', $searchQuery->mobile)
            ->where('birthdate', $searchQuery->birthdate)
            ->first();

        if ($user) {
            return $user;
        }

        return false;
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

        return ! $voted;
    }
}
