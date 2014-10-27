<?php

class CategoriesTableSeeder extends Seeder {

  public function run()
  {
    Category::truncate();

    Category::create([
      'name' => 'Top 20',
      'slug' => 'top-20'
    ]);

    Category::create([
      'name' => 'On the Rise',
      'slug' => 'on-the-rise'
    ]);

    Category::create([
      'name' => 'Internet Celebs',
      'slug' => 'internet-celebs'
    ]);

  }
}
