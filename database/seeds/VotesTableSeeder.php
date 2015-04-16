<?php

use Illuminate\Database\Seeder;
use App\Candidate;
use App\User;
use App\Vote;

class VotesTableSeeder extends Seeder
{

  public function run()
  {
    DB::table('votes')->truncate();

    foreach (range(1, 30) as $index) {
      $candidate = Candidate::orderBy(DB::raw('RAND()'))->first();
      $user = User::orderBy(DB::raw('RAND()'))->first();

      $vote = Vote::create([
        'candidate_id' => $candidate->id,
        'user_id' => $user->id
      ]);

      $vote->save();
    }


  }
}
