<?php namespace VotingApp\Repositories;

use DB;
use Cache;

class BackgroundsRepository
{

    /**
     * Get a cached array of all custom backgrounds.
     *
     * @return array
     */
    public function all()
    {
        $backgrounds = Cache::rememberForever('backgrounds', function() {
            return DB::table('backgrounds')->lists('path');
        });

        return $backgrounds;
    }

    public function random($type, $fallback = '')
    {
        $all = $this->all();
        if(empty($all)) return $fallback;

        $path = $all[mt_rand(0, count($all) - 1)];

        return '/images/backgrounds/'. $path . '_' . $type . '.jpg';
    }

}
