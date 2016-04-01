<?php

use Illuminate\Database\Migrations\Migration;

class AddPhoneCountriesSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'phone_countries',
            'type' => 'text',
            'value' => '',
            'description' => 'Country codes where we ask users for their phone numbers, other than the US which is included by default. Comma separated, no spaces',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->where(['key' => 'phone_countries'])->delete();
    }
}
