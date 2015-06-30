<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWriteinLinkToSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('settings')
            ->where('key', 'writein_email')
            ->update([
                'key' => 'writein_link',
                'description' => 'Link provided for write-in candidates.',
            ]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::table('settings')
            ->where('key', 'writein_link')
            ->update([
                'key' => 'writein_email',
                'description' => 'Email provided for write-in candidates.',
            ]);
	}

}
