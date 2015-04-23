<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'CandidatesController@index']);

/**
 * Authentication & password reset
 */
Route::controllers([
    'auth' => 'AuthController',
    'password' => 'PasswordController'
]);

// Convenience routes
Route::get('admin', function() {
    return redirect()->to('/auth/admin');
});

/**
 * Categories
 */
Route::bind('categories', function ($slug) { return Category::where('slug', $slug)->first(); });
Route::resource('categories', 'CategoriesController');

/**
 * Candidates
 */
Route::bind('candidates', function ($slug) { return Candidate::where('slug', $slug)->first(); });
Route::resource('candidates', 'CandidatesController');

/**
 * Winners
 */
Route::resource('winners', 'WinnersController');

/**
 * Votes
 */
Route::resource('votes', 'VotesController', ['only' => ['store']]);

/**
 * Users
 */
Route::bind('users', function ($id) { return User::where('id', $id)->first(); });
Route::resource('users', 'UsersController', ['only' => ['index', 'create', 'store', 'show']]);

/**
 * Pages
 */
Route::bind('pages', function ($slug) { return Page::where('slug', $slug)->first(); });
Route::resource('pages', 'PagesController');

/**
 * Settings
 */
Route::bind('settings', function ($key) { return Setting::where('key', $key)->first(); });
Route::resource('settings', 'SettingsController', ['only' => ['index', 'edit', 'update']]);
