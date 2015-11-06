<?php

use Illuminate\Database\Migrations\Migration;

class MakeTaglineMarkdown extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')
            ->where(['key' => 'tagline'])
            ->update([
                'type' => 'markdown',
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')
            ->where(['key' => 'tagline'])
            ->update([
                'type' => 'text',
            ]);
    }
}
