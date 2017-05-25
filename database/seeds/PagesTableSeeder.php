<?php

use VotingApp\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        Page::truncate();

        Page::create([
            'title' => 'FAQ',
            'content' => "### What is Lorem Ipsum?\n".
                "Lorem Ipsum is simply dummy text of the printing and typesetting industry.\n".
                "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.\n".
                "\n".
                "### Why?\n".
                "Designers are weird.\n",
        ]);
    }
}
