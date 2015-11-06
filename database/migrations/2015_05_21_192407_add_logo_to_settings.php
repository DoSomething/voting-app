<?php

use Illuminate\Database\Migrations\Migration;

class AddLogoToSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert([
            'key' => 'logo_svg',
            'type' => 'file',
            'description' => 'The logo used for this instance of Voting App, as a SVG image.',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'key' => 'logo_png',
            'type' => 'file',
            'description' => 'The logo used for this instance of Voting App, as a PNG image.',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'key' => 'favicon',
            'type' => 'file',
            'description' => 'The favicon used for this instance of Voting App, as an ICO file.',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'key' => 'touch_icon',
            'type' => 'file',
            'description' => 'The icon used for touch devices, like iPhones or iPads.',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'key' => 'facebook_image',
            'type' => 'file',
            'description' => 'Default share image used for Facebook, for example when sharing the homepage.',
            'value' => '',
        ]);

        DB::table('settings')->insert([
            'key' => 'twitter_image',
            'type' => 'file',
            'description' => 'Default share image used for Twitter, for example when sharing the homepage.',
            'value' => '',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('settings')->delete(['key' => 'logo_svg']);
        DB::table('settings')->delete(['key' => 'logo_png']);
        DB::table('settings')->delete(['key' => 'favicon']);
        DB::table('settings')->delete(['key' => 'touch_icon']);
        DB::table('settings')->delete(['key' => 'facebook_image']);
        DB::table('settings')->delete(['key' => 'twitter_image']);
    }
}
