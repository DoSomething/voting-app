<?php

use Illuminate\Database\Seeder;
use App\Candidate;

class CandidatesTableSeeder extends Seeder
{

  public function run()
  {
    $faker = Faker\Factory::create();

    Candidate::truncate();

    // Top 20
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


    // On the Rise
    foreach (range(1, 6) as $index) {
      $candidate = Candidate::create([
        'name' => $faker->name(),
        'description' => $faker->paragraph(2),
        'category_id' => 2,
      ]);

      $image = Image::make($faker->imageUrl(640, 480, 'people'));
      $candidate->savePhoto($image);
      $candidate->save();
    }

    // Internet Celebs
    foreach (range(1, 4) as $index) {
      $candidate = Candidate::create([
        'name' => $faker->name(),
        'description' => $faker->paragraph(2),
        'category_id' => 3,
      ]);

      $image = Image::make($faker->imageUrl(640, 480, 'cats'));
      $candidate->savePhoto($image);
      $candidate->save();
    }

  }
}
