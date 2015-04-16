<?php

class SettingsRepository
{

  /**
   * Return an array of all settings.
   * @return array Key/value array of settings.
   */
  public function all()
  {
    // @TODO: ->rememberForever('settings') deprecated in Laravel 5!
    return DB::table('settings')->lists('value', 'key');
  }

}
