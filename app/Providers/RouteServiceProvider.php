<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use App\Models\Category;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Page;
use App\Models\Setting;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

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
