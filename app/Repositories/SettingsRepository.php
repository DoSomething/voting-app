<?php

namespace VotingApp\Repositories;

use VotingApp\Models\Setting;
use Parsedown;

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
        $value = app('cache')->rememberForever('settings.'.$key, function () use ($key, $fallback) {
            $setting = Setting::where('key', $key)->first();
            $value = ! empty($setting->value) ? $setting->value : $fallback;

            if (isset($setting->type) && $setting->type === 'markdown') {
                return Parsedown::instance()->text($value);
            }

            return $value;
        });

        return $value;
    }
}
