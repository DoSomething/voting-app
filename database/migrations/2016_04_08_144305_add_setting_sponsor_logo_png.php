<?php

use Illuminate\Database\Migrations\Migration;

class AddSettingSponsorLogoPng extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'sponsor_logo_png',
            'type' => 'file',
            'value' => '',
            'description' => 'Sponsor logo in png format',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->where(['key' => 'sponsor_logo_png'])->delete();
    }
}
