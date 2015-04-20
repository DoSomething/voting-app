<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StoreCountryCode extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('users', function (Blueprint $table) {
      $table->string('country_code')->after('birthdate');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('country_code');
    });
  }
}
