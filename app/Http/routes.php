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

// Homepage
get('/', ['as' => 'home', 'uses' => 'CandidatesController@index']);

// User Authentication
get('logout', 'AuthController@getLogout');

// Admin Authentication
get('admin', 'AuthController@getAdmin');
post('admin', 'AuthController@postAdmin');

// Password Reset
get('password/email', 'PasswordController@getEmail');
post('password/email', 'PasswordController@postEmail');
get('password/reset', 'PasswordController@getReset');
post('password/reset', 'PasswordController@postReset');

// Restful resources
resource('candidates', 'CandidatesController');
resource('categories', 'CategoriesController');
resource('backgrounds', 'BackgroundsController');
resource('pages', 'PagesController');
resource('settings', 'SettingsController', ['only' => ['index', 'update', 'destroy']]);
resource('users', 'UsersController', ['only' => ['index', 'create', 'store', 'show']]);
resource('votes', 'VotesController', ['only' => ['store']]);
resource('winners', 'WinnersController');
resource('winner-categories', 'WinnerCategoriesController');
