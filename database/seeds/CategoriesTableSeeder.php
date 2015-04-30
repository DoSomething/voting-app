<?php

use Illuminate\Database\Seeder;

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
