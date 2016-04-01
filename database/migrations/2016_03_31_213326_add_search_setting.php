<?php

use Illuminate\Database\Migrations\Migration;

class AddSearchSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'search_bar',
            'type' => 'boolean',
            'value' => '1',
            'description' => 'True if search bar is to be displayed',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->delete(['key' => 'search_bar']);
    }
}
