<?php

use Illuminate\Database\Migrations\Migration;

class AddWriteinEmailToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'writein_email',
            'type' => 'text',
            'description' => 'Email provided for write-in candidates.',
            'value' => 'writein@voting.app',
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
