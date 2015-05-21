<?php namespace VotingApp\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Candidate extends Model implements SluggableInterface
{

    use SluggableTrait;



    /**
     * The attributes which may be mass-assigned.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'category_id', 'twitter', 'photo_source'
    ];

    /**
     * Configuration for generating slug with Eloquent-Sluggable.
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug'
    ];

    protected $appends = array('share_name');

    /**
     * Inverse has-many relationship to Categories.
     */
    public function category()
    {
        return $this->belongsTo('VotingApp\Models\Category');
    }

    /**
     * A candidate has many votes.
     */
    public function votes()
    {
        return $this->hasMany('VotingApp\Models\Vote');
    }

    /**
     * A candidate may be a winner.
     */
    public function winner()
    {
        return $this->hasOne('VotingApp\Models\Winner');
    }

    /**
     * @return string
     */
    public function thumbnail()
    {
        if ($this->photo) {
            return '/images/thumbnails/thumb-' . $this->photo;
        } else {
            return asset('images/placeholder.png');
        }
    }

    /**
     * Save a photo, generate thumbnail, and attach it to the model.
     *
     * @param mixed $photo Input to Intervention\Image::make (such as Input::file)
     * @see http://image.intervention.io/api/make
     */
    public function savePhoto($photo)
    {
        // Create directory if it doesn't exist
        if (!file_exists(public_path('images/thumbnails'))) {
            mkdir(public_path('images/thumbnails'), 0777, true);
        }

        $filename = $this->sluggify()->slug . '.jpg';

        // Save full-size image
        $photo->encode('jpg', 75)->save(public_path('images/thumbnails') . '/' . $filename);

        // Save thumbnail
        $photo->encode('jpg', 75)->fit(400)
            ->save(public_path('images/thumbnails') . '/' . 'thumb-' . $filename);

        $this->attributes['photo'] = $filename;
    }

    /**
     * Custom share name attribute
     *
     * @return string twitter handle, or candidate name
     * @see $appends array
     */
    public function getShareNameAttribute()
    {
        return (!empty($this->twitter)) ? $this->twitter : $this->name;
    }

}
