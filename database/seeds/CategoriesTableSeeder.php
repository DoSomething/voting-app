<?php

use Illuminate\Database\Seeder;
use VotingApp\Models\Category;

class CategoriesTableSeeder extends Seeder
{

    public function run()
    {
        Category::truncate();

        Category::create(['name' => 'Basketball']);
        Category::create(['name' => 'Sportsball']);
        Category::create(['name' => 'Fütbol']);
        Category::create(['name' => 'Hockey']);
        Category::create(['name' => 'Golf']);
    }
}
