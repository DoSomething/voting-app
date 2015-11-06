<?php

use Illuminate\Database\Seeder;
use VotingApp\Models\Vote;
use VotingApp\Models\User;
use VotingApp\Models\Candidate;

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
                'user_id' => $user->id,
            ]);

            $vote->save();
        }
    }
}
