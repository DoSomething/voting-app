<?php namespace VotingApp\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;
use Image;

class Background extends Model {

    public static function boot()
    {
        parent::boot();

        static::created(function() {
            if (Cache::has('backgrounds')) {
                Cache::forget('backgrounds');
            }
        });

        static::deleted(function() {
            if (Cache::has('backgrounds')) {
                Cache::forget('backgrounds');
            }
        });

    }

    /**
     * Save compressed & scaled versions of background image.
     *
     * @param mixed $file - see: http://image.intervention.io/api/make
     */
    public function saveImage($file)
    {
        // Create directory if it doesn't exist
        if (!file_exists(public_path('images/backgrounds'))) {
            mkdir(public_path('images/backgrounds'), 0777, true);
        }

        $image = Image::make($file);

        $filename = $image->filename;
        $this->path = $filename;

        // Save full-size image
        $image->encode('jpg', 50)->resize(1400, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(public_path('images/backgrounds') . '/' . $filename. '_retina.jpg');

        // Save medium-size image
        $image->encode('jpg', 50)->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(public_path('images/backgrounds') . '/' . $filename . '_regular.jpg');

        // Save thumbnail
        $image->encode('jpg', 50)->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(public_path('images/backgrounds') . '/' . $filename . '_thumbnail.jpg');
    }

    /**
     * Return image URL for a given background & size.
     *
     * @param string $type
     * @return string
     * @throws \Exception
     */
    public function url($type = 'regular')
    {
        switch ($type) {
            case 'regular':
            case 'retina':
            case 'thumbnail':
                break;
            default:
                throw new \Exception('Invalid image type provided.');
        }

        return '/images/backgrounds/' . $this->path . '_' . $type . '.jpg';
    }

}
