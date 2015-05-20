<?php namespace VotingApp\Repositories;

use VotingApp\Models\Setting;
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

    /**
     * Get a cached value of a particular setting, or a
     * fallback if setting is not set.
     * @param string $key
     * @param string $fallback
     * @return mixed
     */
    public function get($key, $fallback = '')
    {
        $setting = Cache::rememberForever('settings.' . $key, function() use($key) {
            return $setting = Setting::where('key', $key)->first();
        });

        if(!$setting) return $fallback;

        return $setting->value;
    }

}
