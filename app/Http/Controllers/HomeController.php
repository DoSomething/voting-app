<?php

class HomeController extends \Controller
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    | Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function index()
    {
        $category = Category::find(1);
        $type = get_login_type();
        if ($category) {
            $candidates = $category->candidates;
            $winners = Winner::getCategoryWinners($category);
            return \View::make('categories.show', compact('category', 'candidates', 'type', 'winners'));
        } else {
            return \View::make('categories.create');
        }
    }
}
