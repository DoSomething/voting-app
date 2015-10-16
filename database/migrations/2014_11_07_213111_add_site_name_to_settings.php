<?php

use Illuminate\Database\Migrations\Migration;

class AddSiteNameToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'site_title',
            'value' => 'Voting App',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->delete(['key' => 'site_title']);
    }
}
