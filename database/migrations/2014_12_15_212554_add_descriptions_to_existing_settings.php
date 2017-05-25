<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionsToExistingSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            // Add a description to previously added twitter_language row
            DB::table('settings')
                ->where(['key' => 'twitter_language'])
                ->update(['description' => 'Twitter language used for sharing links to individual candidates. Use TWITTER_NAME as a placeholder for candidate\'s Twitter.']);

            // Add description to previously added tagline row
            DB::table('settings')
                ->where(['key' => 'tagline'])
                ->update(['description' => 'The site tagline is displayed below the logo, and used to introduce visitors to the campaign & provide directions or status updates.']);

            // Add description to previously added site title row
            DB::table('settings')
                ->where(['key' => 'site_title'])
                ->update(['description' => 'The site title is the name of this particular campaign (ex: Celebs Gone Good) and is used throughout the site.']);
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
            DB::table('settings')
                ->where(['key' => 'site_title'])
                ->update(['description' => null]);

            DB::table('settings')
                ->where(['key' => 'tagline'])
                ->update(['description' => null]);

            DB::table('settings')
                ->where(['key' => 'twitter_language'])
                ->update(['description' => null]);
        });
    }
}
