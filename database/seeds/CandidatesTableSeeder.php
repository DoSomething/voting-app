<?php

use Illuminate\Database\Seeder;
use VotingApp\Models\Candidate;

class CandidatesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        Candidate::truncate();

        // Add 40 candidates to each of the 5 seeded categories.
        foreach (range(1, 5) as $category_id) {
            foreach (range(1, 40) as $index) {
                $candidate = Candidate::create([
                    'name' => $faker->name(),
                    'description' => $faker->paragraph(2),
                    'category_id' => $category_id,
                    'gender' => $faker->randomElement(['M', 'F', 'X']),
                ]);

                $image = $faker->file(base_path('database/seeds/images/candidates'), '/tmp');
                $candidate->savePhoto($image);
                $candidate->save();
            }
        }
    }
}
