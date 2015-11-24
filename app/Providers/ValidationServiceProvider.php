<?php

namespace VotingApp\Providers;

use Illuminate\Support\ServiceProvider;
use VotingApp\LocalizedDate;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * The validator instance.
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

        $this->validator->extend('phone', function ($attribute, $value, $parameters) {
            $phoneRegex = '/^(?:\+?([0-9]{1,3})([\-\s\.]{1})?)?\(?([0-9]{3})\)?(?:[\-\s\.]{1})?([0-9]{3})(?:[\-\s\.]{1})?([0-9]{4})/';

            return preg_match($phoneRegex, $value);
        }, 'The :attribute must be a valid phone number.');

        $this->validator->extend('localized_date', function ($attribute, $value, $parameters) {
            return LocalizedDate::validate($value);
        }, 'Enter your :attribute '.LocalizedDate::getExpectedFormat().'.');
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
