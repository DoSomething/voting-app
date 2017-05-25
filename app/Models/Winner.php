<?php

namespace VotingApp\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    /**
     * The attributes which may be mass-assigned.
     *
     * @var array
     */
    protected $fillable = [
        'candidate_id', 'rank', 'description', 'winner_category_id',
    ];

    // No timestamps on the winners table.
    public $timestamps = false;

    /**
     * A winner belongs to a candidate.
     */
    public function candidate()
    {
        return $this->belongsTo('VotingApp\Models\Candidate');
    }

    /**
     * Inverse has-many relationship to Winner Categories.
     */
    public function winnerCategory()
    {
        return $this->belongsTo('VotingApp\Models\WinnerCategory');
    }

    /**
     * Get the winners, given a category.
     * @param Category $category
     */
    public static function getCategoryWinners(Category $category)
    {
        $settings = app()->make('VotingApp\Repositories\SettingsRepository');
        $secrets = \Request::get('winners');
        if ($settings->get('show_winners') || $secrets == '✓') {
            $winners = DB::table('winners')
                ->join('candidates', 'winners.candidate_id', '=', 'candidates.id')
                ->join('categories', 'candidates.category_id', '=', 'categories.id')
                ->where('categories.id', '=', $category->id)
                ->select('winners.rank', 'winners.description', 'candidates.name', 'candidates.slug', 'candidates.photo', 'candidates.id')
                ->orderBy('winners.rank')
                ->get();

            return $winners;
        }
    }
}
