<?php

use Illuminate\Database\Migrations\Migration;

class AddCandidateTypeToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'candidate_type',
            'type' => 'text',
            'value' => 'candidate',
            'description' => 'The "type" of candidate being voted for (e.g. "celeb" or "athlete")',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->delete(['key' => 'candidate_type']);
    }
}
