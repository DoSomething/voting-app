<?php

namespace VotingApp\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class WinnerCategory extends Model implements SluggableInterface
{
    use SluggableTrait;

    /**
     * The attributes which may be mass-assigned.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Configuration for generating slug with Eloquent-Sluggable.
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];

    /**
     * A winner category has many winners. (Well, sort of. There's still
     * one *real winner* but there's like a lot of runner-ups).
     *
     * @return mixed
     */
    public function winners()
    {
        return $this->hasMany('VotingApp\Models\Winner')->orderBy('rank', 'asc');
    }
}
