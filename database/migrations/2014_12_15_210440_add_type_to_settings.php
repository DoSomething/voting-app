<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTypeToSettings extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('settings', function (Blueprint $table) {
      $table->string('type')->default('text');
      $table->text('description')->nullable();
    });
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::table('settings', function (Blueprint $table) {
      $table->dropColumn('description');
      $table->dropColumn('type');
    });
  }
}
