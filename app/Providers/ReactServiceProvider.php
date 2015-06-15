<?php namespace VotingApp\Providers;

use Illuminate\Support\ServiceProvider;
use VotingApp\Services\ReactService;
use Blade;

class ReactServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Register blade `@react` helper function
        Blade::extend(function($view, $compiler) {
            $pattern = $compiler->createMatcher('react');
            return preg_replace($pattern, '<?php echo app("react")->render$2; ?>', $view);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;
        $app['react'] = $app->share(function ($app) {
            return new ReactService($app['config']->get('services.react.url'));
        });
    }

}
