<?php

use Illuminate\Database\Migrations\Migration;

class RemoveWriteinLinkSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->where(['key' => 'writein_link'])->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->insert([
            'key' => 'writein_link',
            'type' => 'text',
            'value' => '',
            'description' => 'Link provided for write-in candidates.',
        ]);
    }
}
