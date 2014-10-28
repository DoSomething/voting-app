<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'CandidatesController@index');

/**
 * Candidates
 */
Route::bind('candidates', function($slug) {
  return Candidate::whereSlug($slug)->first();
});

Route::resource('candidates', 'CandidatesController');


/**
 * Categories
 */
Route::bind('categories', function($slug) {
  return Category::whereSlug($slug)->first();
});

Route::resource('categories', 'CategoriesController');

/**
 * Users
 */
Route::resource('users', 'UsersController', ['only' => ['create', 'store']]);

