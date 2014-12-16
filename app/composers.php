<?php

/**
 * View Composer for main layout.
 */
View::composer('layout', function($view)
{
  $categories = Category::rememberForever('categories')->get();
  $settings = App::make('SettingsRepository')->all();
  return $view->with('settings', $settings)->with('categories', $categories);
});

/**
 * View Composer for candidate page.
 */
View::composer('candidates.show', function($view)
{
  $settings = App::make('SettingsRepository')->all();
  return $view->with('settings', $settings);
});

View::composer('candidates.voteForm', function($view)
{
  $settings = App::make('SettingsRepository')->all();
  return $view->with('settings', $settings);
});

/**
 *
 */
View::composer('categories.show', function($view)
{
  $settings = App::make('SettingsRepository')->all();
  return $view->with('settings', $settings);
});
