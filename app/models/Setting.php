<?php

class Setting extends \Eloquent {

  public static function boot()
  {
    parent::boot();

    static::updating(function($post)
    {
      if(Cache::has('settings')) {
        Cache::forget('settings');
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
   * Returns a nice human-readable value.
   */
  public function pretty_value() {
    // Display a boolean type:
    if($this->type == 'boolean') {
      return ($this->value ? '✓ on' : '<span class="empty"> ✘ off </span> ');
    }

    // Display empty strings:
    if(empty($this->value)) {
      return '<span class="empty">(empty)</span>';
    }

    // Anything else:
    return e($this->value);
  }

}
