<?php namespace VotingApp\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Winner extends Model
{

    /**
     * The attributes which may be mass-assigned.
     *
     * @var array
     */
    protected $fillable = [
        'candidate_id', 'rank', 'description'
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

        return;
    }

}
