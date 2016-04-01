<?php

use Illuminate\Database\Migrations\Migration;

class AddToggleWriteInSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'write_ins',
            'type' => 'markdown',
            'value' => '',
            'description' => 'The text to display to ask for write in votes',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->where(['key' => 'write_ins'])->delete();
    }
}
