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
            'type' => 'boolean',
            'value' => '1',
            'description' => 'True write ins are accepted',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->delete(['key' => 'write_ins']);
    }
}
