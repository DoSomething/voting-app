<?php

use Illuminate\Database\Migrations\Migration;

class AddSponsorLogoSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'sponsor_logo_svg',
            'type' => 'file',
            'value' => '',
            'description' => 'Sponsor logo in svg format',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->where(['key' => 'sponsor_logo_svg'])->delete();
    }
}
