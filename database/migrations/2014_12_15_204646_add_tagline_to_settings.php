<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTaglineToSettings extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::table('settings')->insert([
      'key' => 'tagline',
      'value' => 'Vote for your favorite celeb who has done kickass things in the world. Vote once per day in each category, and don\'t forget voting ends December 24th!'
    ]);
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::table('settings')->delete(['key' => 'tagline']);
  }

}
