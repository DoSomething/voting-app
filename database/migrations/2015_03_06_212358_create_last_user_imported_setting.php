<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLastUserImportedSetting extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      DB::table('settings')->insert([
      'key' => 'last_user_imported',
      'value' => -1
    ]);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      DB::table('settings')->delete(['key' => 'last_user_imported']);
  }
}
