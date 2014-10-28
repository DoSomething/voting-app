<?php

class UsersTableSeeder extends Seeder {

  public function run()
  {
    $faker = Faker\Factory::create();

    User::truncate();

    foreach(range(1,50) as $index) {
      User::create([
        'email' => $faker->unique()->safeEmail,
        'password' => 'tops3cret'
      ]);
    }
  }
}
