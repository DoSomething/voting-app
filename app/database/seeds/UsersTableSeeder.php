<?php

class UsersTableSeeder extends Seeder {

  public function run()
  {
    $faker = Faker\Factory::create();

    User::truncate();

    User::create([
      'email' => 'dfurnes@dosomething.org',
      'password' => 'tops3cret',
      ])->assignRole(1);

    User::create([
      'email' => 'agaither@dosomething.org',
      'password' => 'tops3cret',
      ])->assignRole(1);

    foreach(range(1,50) as $index) {
      User::create([
        'email' => $faker->unique()->safeEmail,
        'password' => 'tops3cret'
      ]);
    }
  }
}
