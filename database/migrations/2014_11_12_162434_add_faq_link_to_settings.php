<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFaqLinkToSettings extends Migration
{

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::table('settings')->insert([
      'key' => 'faq_link_text',
      'value' => 'FAQs'
    ]);

    DB::table('settings')->insert([
      'key' => 'faq_link_url',
      'value' => '/pages/faq'
    ]);
  }


  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::table('settings')->delete(['key' => 'faq_link_text']);
    DB::table('settings')->delete(['key' => 'faq_link_url']);
  }

}
