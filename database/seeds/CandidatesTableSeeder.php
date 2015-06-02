<?php

use Illuminate\Database\Seeder;
use VotingApp\Models\Candidate;

class CandidatesTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        Candidate::truncate();

        // Basketball
        foreach(range(1, 5) as $category_id) {
            foreach (range(1, 12) as $index) {
                $candidate = Candidate::create([
                    'name' => $faker->name(),
                    'description' => $faker->paragraph(2),
                    'category_id' => $category_id,
                ]);

                $image = $faker->file(base_path('database/seeds/images/candidates'), '/tmp');
                $candidate->savePhoto($image);
                $candidate->save();
            }
        }
    }
}
