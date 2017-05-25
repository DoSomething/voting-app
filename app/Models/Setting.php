<?php

namespace VotingApp\Models;

use Cache;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Setting extends Model
{
    public static function boot()
    {
        parent::boot();

        static::updating(function ($setting) {
            if (Cache::has('settings.'.$setting->key)) {
                Cache::forget('settings.'.$setting->key);
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

    /**
     * Save a file, and store the path.
     * @param File|UploadedFile $file
     */
    public function saveFile($file)
    {
        $path = public_path('images/settings');

        // Create directory if it doesn't exist
        if (! file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // Get extension
        if ($file instanceof UploadedFile) {
            $extension = $file->getClientOriginalExtension();
        } else {
            $extension = $file->getExtension();
        }

        $filename = $this->key.'.'.$extension;
        $file->move($path, $filename);

        $this->value = 'images/settings/'.$filename;
    }
}
