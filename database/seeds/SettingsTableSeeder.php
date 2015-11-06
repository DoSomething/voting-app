<?php

use Illuminate\Database\Seeder;
use Symfony\Component\HttpFoundation\File\File;
use VotingApp\Models\Setting;
use Faker\Provider\Uuid;

class SettingsTableSeeder extends Seeder
{
    /**
     * Create a temporary file for seeding file uploads.
     *
     * @param $path
     * @return bool|File
     */
    public function seedFile($path)
    {
        $sourcePath = base_path('database/seeds').'/'.$path;

        $destinationFile = Uuid::uuid().'.'.pathinfo($sourcePath, PATHINFO_EXTENSION);
        $destinationFullPath = '/tmp/'.$destinationFile;

        if (false === copy($sourcePath, $destinationFullPath)) {
            return false;
        }

        return new File($destinationFullPath);
    }

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
        $logo_svg->saveFile($this->seedFile('images/cats-gone-good.svg'), 'cats-gone-good.svg');
        $logo_svg->save();

        // Logo PNG
        $logo_png = Setting::where('key', 'logo_png')->first();
        $logo_png->saveFile($this->seedFile('images/cats-gone-good.png'), 'cats-gone-good.png');
        $logo_png->save();
    }
}
