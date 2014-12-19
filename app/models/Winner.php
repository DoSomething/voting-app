<?php

class Winner extends Eloquent {

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
   */
  public static function getCategoryWinners(category $category)
  {
    $settings = App::make('SettingsRepository')->all();
    if ($settings['show_winners']) {
      $winners = DB::table('winners')
                    ->join('candidates', 'winners.candidate_id', '=', 'candidates.id')
                    ->join('categories', 'candidates.category_id', '=', 'categories.id')
                    ->where('categories.name', '=', $category->name)
                    ->select('winners.rank', 'winners.description', 'candidates.name', 'candidates.slug', 'candidates.photo', 'candidates.id')
                    ->orderBy('winners.rank')
                    ->get();

      // $winners = Winner::with('candidate')
      //             ->join('candidates as can', 'can.id', '=', 'winners.candidate_id')
      //             ->join('categories as cat', 'cat.id', '=', 'can.category_id')
      //             ->where('cat.id', $category->id)
      //             ->orderBy('rank')->get();
      return $winners;
    }
    return;

  }
}
