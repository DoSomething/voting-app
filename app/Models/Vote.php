<?php

namespace VotingApp\Models;

use VotingApp\Events\UserCastVote;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vote extends Model
{
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
        return $this->belongsTo('VotingApp\Models\User');
    }

    /**
     * A vote belongs to a Candidate.
     */
    public function candidate()
    {
        return $this->belongsTo('VotingApp\Models\Candidate');
    }

    /**
     * Assuming a user is eligible to vote, save the vote.
     * @param $candidate_id
     * @param $user_id
     * @return Vote
     */
    public static function createIfEligible($candidate_id, $user_id)
    {
        // Look up user and candidate
        $user = User::find($user_id);

        // Can the user vote?
        if (! $user->canVote()) {
            return false;
        }

        // Create the vote.
        $vote = self::create([
            'candidate_id' => $candidate_id,
            'user_id' => $user_id,
        ]);

        event(new UserCastVote($vote));

        return $vote;
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
