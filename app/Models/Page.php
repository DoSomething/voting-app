<?php

namespace VotingApp\Models;

use Parsedown;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Page extends Model implements SluggableInterface
{
    use SluggableTrait;

    /**
     * The attributes which may be mass-assigned.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content',
    ];

    /**
     * Configuration for generating slug with Eloquent-Sluggable.
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug',
    ];

    public function setContentAttribute($content)
    {
        $this->attributes['content'] = $content;
        $this->attributes['content_html'] = Parsedown::instance()->text($content);
    }
}
