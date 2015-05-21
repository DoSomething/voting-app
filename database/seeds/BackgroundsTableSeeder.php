<?php

use Illuminate\Database\Seeder;
use VotingApp\Models\Background;

class BackgroundsTableSeeder extends Seeder
{

    public function run()
    {
        Background::truncate();

        $one = new Background();
        $one->saveImage(base_path('database/seeds/backgrounds/tabby1.jpg'));
        $one->save();

        $two = new Background();
        $two->saveImage(base_path('database/seeds/backgrounds/tabby2.jpg'));
        $two->save();

        $three = new Background();
        $three->saveImage(base_path('database/seeds/backgrounds/tabby3.jpg'));
        $three->save();

    }
}
