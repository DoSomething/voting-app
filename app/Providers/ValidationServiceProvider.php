<?php namespace VotingApp\Providers;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider {

    /**
     * The validator instance
     *
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->validator = $this->app->make('validator');

        $this->validator->extend('phone', function($attribute, $value, $parameters)
        {
            $phoneRegex = '/^((1)?([\-\s\.]{1})?)?\(?([0-9]{3})\)?(?:[\-\s\.]{1})?([0-9]{3})(?:[\-\s\.]{1})?([0-9]{4})/';

            return preg_match($phoneRegex, $value);
        }, 'The :attribute must be a valid phone number.');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
