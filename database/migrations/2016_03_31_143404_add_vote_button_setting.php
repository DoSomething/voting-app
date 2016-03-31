<?php

use Illuminate\Database\Migrations\Migration;

class AddVoteButtonSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'vote_button',
            'type' => 'boolean',
            'value' => '1',
            'description' => 'True if the vote button is to be displayed',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->delete(['key' => 'vote_button']);
    }
}
