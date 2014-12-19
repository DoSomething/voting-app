<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShowWinnersToSettings extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::table('settings')->insert([
      'key' => 'show_winners',
      'type' => 'boolean',
      'description' => 'Enable this setting to display winners in each category. This will only work if voting is disabled.',
      'value' => ''
    ]);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::table('settings')->delete(['key' => 'show_winners']);
  }

}
