<?php

class CategoriesTableSeeder extends Seeder {

  public function run()
  {
    Category::truncate();

    Category::create(['name' => 'Top 20']);
    Category::create(['name' => 'On the Rise']);
    Category::create(['name' => 'Internet Celebs']);

  }
}
