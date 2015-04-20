<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddEnableVotingToSettings extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'enable_voting',
            'type' => 'boolean',
            'description' => 'Enable this setting to allow users to vote. If disabled, vote buttons & forms will be removed.',
            'value' => 1
        ]);

        DB::statement('ALTER TABLE `settings` MODIFY `type` VARCHAR(255) AFTER `value`');
        DB::statement('ALTER TABLE `settings` MODIFY `description` TEXT AFTER `type`');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->delete(['key' => 'enable_voting']);
    }
}
