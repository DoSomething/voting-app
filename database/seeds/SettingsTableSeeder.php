<?php

use Illuminate\Database\Seeder;
use Symfony\Component\HttpFoundation\File\File;
use VotingApp\Models\Setting;

class SettingsTableSeeder extends Seeder
{

    /**
     *
     */
    public function run()
    {
        // Site Title
        $site_title = Setting::where('key', 'site_title')->first();
        $site_title->value = 'Cats Gone Good';
        $site_title->save();

        // Candidate Type
        $candidate_type = Setting::where('key', 'candidate_type')->first();
        $candidate_type->value = 'kitten';
        $candidate_type->save();

        // Tagline
        $tagline = Setting::where('key', 'tagline')->first();
        $tagline->value = 'Vote for the cutest kitten of the year. Vote once per day, and choose wisely!';
        $tagline->save();

        // Logo SVG
        $logo_svg = Setting::where('key', 'logo_svg')->first();
        $logo_svg->saveFile(new File(base_path('database/seeds/images/cats-gone-good.svg'), 'cats-gone-good.svg'));
        $logo_svg->save();

        // Logo PNG
        $logo_png = Setting::where('key', 'logo_png')->first();
        $logo_png->saveFile(new File(base_path('database/seeds/images/cats-gone-good.png'), 'cats-gone-good.png'));
        $logo_png->save();

    }
}
