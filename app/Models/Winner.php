<?php

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{

  /**
   * The attributes which may be mass-assigned.
   *
   * @var array
   */
  protected $fillable = [
    'rank', 'description'
  ];

  // No timestamps on the winners table.
  public $timestamps = false;

  /**
   * A winner belongs to a candidate.
   */
  public function candidate()
  {
      return $this->belongsTo('Candidate');
  }

  /**
   * Get the winners, given a category.
   * @param Category $category
   */
  public static function getCategoryWinners(Category $category)
  {
      $settings = \App::make('SettingsRepository')->all();
      $secrets = \Request::get('winners');
      if ($settings['show_winners'] || $secrets == '✓') {
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
