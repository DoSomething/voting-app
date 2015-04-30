<?php

use Illuminate\Database\Seeder;

class CandidatesTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        Candidate::truncate();

        // Basketball
        foreach (range(1, 8) as $index) {
            $candidate = Candidate::create([
                'name' => $faker->name(),
                'description' => $faker->paragraph(2),
                'category_id' => 1,
            ]);

            $image = Image::make($faker->imageUrl(640, 480, 'cats'));
            $candidate->savePhoto($image);
            $candidate->save();
        }


        // Sportsball
        foreach (range(1, 12) as $index) {
            $candidate = Candidate::create([
                'name' => $faker->name(),
                'description' => $faker->paragraph(2),
                'category_id' => 2,
            ]);

            $image = Image::make($faker->imageUrl(640, 480, 'cats'));
            $candidate->savePhoto($image);
            $candidate->save();
        }

        // Fütbol
        foreach (range(1, 16) as $index) {
            $candidate = Candidate::create([
                'name' => $faker->name(),
                'description' => $faker->paragraph(2),
                'category_id' => 3,
            ]);

            $image = Image::make($faker->imageUrl(640, 480, 'cats'));
            $candidate->savePhoto($image);
            $candidate->save();
        }

        // Hockey
        foreach (range(1, 12) as $index) {
            $candidate = Candidate::create([
                'name' => $faker->name(),
                'description' => $faker->paragraph(2),
                'category_id' => 4,
            ]);

            $image = Image::make($faker->imageUrl(640, 480, 'cats'));
            $candidate->savePhoto($image);
            $candidate->save();
        }

        // Golf
        foreach (range(1, 8) as $index) {
            $candidate = Candidate::create([
                'name' => $faker->name(),
                'description' => $faker->paragraph(2),
                'category_id' => 5,
            ]);

            $image = Image::make($faker->imageUrl(640, 480, 'cats'));
            $candidate->savePhoto($image);
            $candidate->save();
        }
    }
}
