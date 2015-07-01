<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwitterSiteLanguageToSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('settings')->insert([
            'key' => 'twitter_site_language',
            'type' => 'text',
            'value' => '.@dosomething\'s #VotingApp is back. Vote now:',
            'description' => 'Language used when sharing the site on Twitter.'
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->delete(['key' => 'twitter_site_language']);
	}

}
