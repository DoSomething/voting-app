<?php namespace VotingApp\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class Setting extends Model
{

    public static function boot()
    {
        parent::boot();

        static::updating(function ($setting) {
            if (Cache::has('settings.' . $setting->key)) {
                Cache::forget('settings.' . $setting->key);
            }
        });
    }

    /**
     * Primary key used to reference this model in the DB.
     */
    protected $primaryKey = 'key';

    /**
     * The attributes which may be mass-assigned.
     *
     * @var array
     */
    protected $fillable = ['key', 'value'];

}
