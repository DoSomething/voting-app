<?php

use Illuminate\Database\Migrations\Migration;

class AddShowTitleSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'show_title',
            'type' => 'boolean',
            'value' => '1',
            'description' => 'True if the title is to be shown on the tiles',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->delete(['key' => 'show_title']);
    }
}
