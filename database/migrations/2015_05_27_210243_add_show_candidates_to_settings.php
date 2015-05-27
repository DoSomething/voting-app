<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShowCandidatesToSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('settings')->insert([
            'key' => 'show_candidates',
            'type' => 'boolean',
            'description' => 'Disable this setting if you want to hide candidates from users (for example, before launch).',
            'value' => '1'
        ]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::table('settings')->delete(['key' => 'show_candidates']);
	}

}
