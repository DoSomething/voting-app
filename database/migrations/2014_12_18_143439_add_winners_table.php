<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWinnersTable extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('winners', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('candidate_id')->unsigned();
      $table->integer('rank')->unsigned()->nullable();
      $table->text('description');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('winners');
  }
}
