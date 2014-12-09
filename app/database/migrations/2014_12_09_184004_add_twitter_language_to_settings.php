<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTwitterLanguageToSettings extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::table('settings')->insert([
      'key' => 'twitter_language',
      'value' => 'Vote for TWITTER_NAME for #VotingApp with @dosomething!'
    ]);
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::table('settings')->delete(['key' => 'twitter_language']);
  }

}
