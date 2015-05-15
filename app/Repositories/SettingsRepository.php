<?php namespace App\Repositories;

use Cache;
use DB;

class SettingsRepository
{

    /**
     * Return a cached array of all settings.
     * @return array - Key/value array of settings.
     */
    public function all()
    {
        return Cache::rememberForever('settings', function() {
            return DB::table('settings')->lists('value', 'key');
        });
    }

}
