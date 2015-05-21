<?php namespace VotingApp\Repositories;

use VotingApp\Models\Setting;
use Cache;

class SettingsRepository
{

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

        if(empty($setting->value)) return $fallback;

        return $setting->value;
    }

}
