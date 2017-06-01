<?php

use VotingApp\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        User::truncate();

        $dave = User::create([
            'first_name' => 'Dave',
            'email' => 'dfurnes@dosomething.org',
        ]);
        $dave->admin = true;
        $dave->save();

        $andrea = User::create([
            'first_name' => 'Andrea',
            'email' => 'agaither@dosomething.org',
        ]);
        $andrea->admin = true;
        $andrea->save();

        foreach (range(1, 250) as $index) {
            User::create([
                'first_name' => $faker->firstName,
                'email' => $faker->unique()->safeEmail,
                'birthdate' => $faker->date($format = 'd-m-Y', $max = 'now'),
                'country_code' => $faker->countryCode,
            ]);
        }

        foreach (range(1, 250) as $index) {
            User::create([
                'first_name' => $faker->firstName,
                'mobile' => $faker->unique()->phoneNumber,
                'birthdate' => $faker->date($format = 'd-m-Y', $max = 'now'),
                'country_code' => 'US',
            ]);
        }
    }
}
