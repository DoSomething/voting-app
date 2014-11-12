<?php

/**
 * View Composer for main layout.
 */
View::composer('layout', function($view)
{
  $categories = Category::all();
  $settings = App::make('SettingsRepository')->all();
  return $view->with('settings', $settings)->with('categories', $categories);
});
