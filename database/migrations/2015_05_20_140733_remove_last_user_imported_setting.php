<?php

use Illuminate\Database\Migrations\Migration;

class RemoveLastUserImportedSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->where(['key' => 'last_user_imported'])->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->insert([
            'key' => 'last_user_imported',
            'value' => -1,
        ]);
    }
}
