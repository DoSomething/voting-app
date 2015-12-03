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

        // Add custom validator for localized date (e.g. `MM/DD/YYYY` or `DD/MM/YYYY`).
        $this->validator->extend('localized_date', function ($attribute, $value, $parameters) {
            return LocalizedDate::validate($value);
        }, 'Enter your :attribute in :expected_date_format.');

        $this->validator->replacer('localized_date', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':expected_date_format', LocalizedDate::getExpectedFormat(), $message);
        });
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
