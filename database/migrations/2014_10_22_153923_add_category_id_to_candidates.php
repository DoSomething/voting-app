<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryIdToCandidates extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::table('candidates', function (Blueprint $table) {
      $table->integer('category_id')->unsigned();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::table('candidates', function (Blueprint $table) {
      $table->dropColumn('category_id');
    });
  }
}
