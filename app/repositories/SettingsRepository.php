<?php

use Illuminate\Support\Facades\DB;

class SettingsRepository {

  /**
   * Return an array of all settings.
   * @return array Key/value array of settings.
   */
  public function all()
  {
    return DB::table('settings')->rememberForever('settings')->lists('value', 'key');
  }

}
