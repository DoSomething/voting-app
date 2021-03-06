<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call('BackgroundsTableSeeder');
        $this->call('SettingsTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('CandidatesTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('VotesTableSeeder');
        $this->call('PagesTableSeeder');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
