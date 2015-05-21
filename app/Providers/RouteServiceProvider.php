<?php namespace VotingApp\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use VotingApp\Models\Background;
use VotingApp\Models\Category;
use VotingApp\Models\Candidate;
use VotingApp\Models\User;
use VotingApp\Models\Page;
use VotingApp\Models\Setting;
use VotingApp\Models\Winner;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'VotingApp\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        $router->bind('categories', function ($slug) {
            return Category::where('slug', $slug)->first();
        });

        $router->bind('candidates', function ($slug) {
            return Candidate::where('slug', $slug)->first();
        });

        $router->bind('users', function ($id) {
            return User::where('id', $id)->first();
        });

        $router->bind('pages', function ($slug) {
            return Page::where('slug', $slug)->first();
        });

        $router->bind('settings', function ($key) {
            return Setting::where('key', $key)->first();
        });

        $router->bind('winners', function ($id) {
            return Winner::where('id', $id)->first();
        });

        $router->bind('backgrounds', function ($id) {
            return Background::where('id', $id)->first();
        });

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
