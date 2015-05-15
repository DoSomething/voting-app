<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the Users of a specific Role.
     * @return object
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
