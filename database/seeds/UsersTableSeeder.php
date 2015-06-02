<?php

use Illuminate\Database\Seeder;
use VotingApp\Models\User;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        User::truncate();

        User::create([
            'first_name' => 'Dave',
            'email' => 'dfurnes@dosomething.org',
            'password' => 'tops3cret',
        ])->assignRole(1);

        User::create([
            'first_name' => 'Andrea',
            'email' => 'agaither@dosomething.org',
            'password' => 'tops3cret',
        ])->assignRole(1);

        User::create([
            'first_name' => 'Naomi',
            'email' => 'nhirabayashi@dosomething.org',
            'password' => 'tops3cret',
        ])->assignRole(1);

        foreach (range(1, 25) as $index) {
            User::create([
                'first_name' => $faker->firstName,
                'email' => $faker->unique()->safeEmail,
                'birthdate' => $faker->date($format = 'm/d/Y', $max = 'now'),
            ]);
        }

        foreach (range(1, 25) as $index) {
            User::create([
                'first_name' => $faker->firstName,
                'phone' => $faker->unique()->phoneNumber,
                'birthdate' => $faker->date($format = 'm/d/Y', $max = 'now'),
            ]);
        }
    }
}
