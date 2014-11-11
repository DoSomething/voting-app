<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RearrangeColOrder extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::statement('ALTER table `candidates` MODIFY COLUMN category_id INT(10) AFTER `id`;');
    DB::statement('ALTER table `candidates` MODIFY COLUMN photo VARCHAR(255) AFTER `description`');

  }
}
