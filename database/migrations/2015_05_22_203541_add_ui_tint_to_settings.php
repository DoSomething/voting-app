<?php

use Illuminate\Database\Migrations\Migration;

class AddUiTintToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'ui_tint',
            'type' => 'text',
            'description' => 'A valid CSS color to use for interface items.',
            'value' => '',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->delete(['key' => 'ui_tint']);
    }
}
