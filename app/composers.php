<?php

/**
 * View Composer for main layout.
 */
View::composer('layout', function($view)
{
  $allSettings = App::make('SettingsRepository')->all();
  return $view->with('settings', $allSettings);
});
