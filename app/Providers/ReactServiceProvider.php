<?php

namespace VotingApp\Providers;

use Blade;
use VotingApp\Services\ReactService;
use Illuminate\Support\ServiceProvider;

class ReactServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Register blade `@react` helper function
        Blade::directive('react', function ($expression) {
            return '<?php echo app("VotingApp\Services\ReactService")->render'.$expression.'; ?>';
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('VotingApp\Services\ReactService', function ($app) {
            return new ReactService($app['config']->get('services.react.url'));
        });
    }
}
