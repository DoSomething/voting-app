<?php

namespace VotingApp;

use Carbon\Carbon;

class LocalizedDate extends Carbon
{
    public function __construct($time = null, $countryCode = null, $timezone = null)
    {
        $time = static::normalize($time, $countryCode);
        parent::__construct($time, $timezone);
    }

    /**
     * Get expected date format by current session's country code.
     *
     * @param string $countryCode - Optionally, override country code
     * @return string
     */
    public static function getExpectedFormat($countryCode = null)
    {
        // Get country code from current session if not provided
        if ($countryCode === null) {
            $countryCode = get_country_code();
        }

        return $countryCode === 'US' ? 'MM/DD/YYYY' : 'DD/MM/YYYY';
    }

    /**
     * Normalize a given time by the application's current
     * country code. Parses MM/DD/YYYY formatted dates in US,
     * and DD/MM/YYYY elsewhere.
     *
     * @param string $time - Date (to be passed to DateTime constructor)
     * @param string $countryCode - Optionally, override country code
     * @return string
     */
    public static function normalize($time, $countryCode = null)
    {
        // Get country code from current session if not provided
        if ($countryCode === null) {
            $countryCode = get_country_code();
        }

        // Force '/' separators, which indicate MM/DD/YYYY in the US, and '-' separators
        // in other countries, which indicates DD-MM-YYYY.
        //
        // From the PHP documentation:
        //
        //     "Dates in the m/d/y or d-m-y formats are disambiguated by looking at the
        //     separator between the various components: if the separator is a slash (/),
        //     then the American m/d/y is assumed; whereas if the separator is a dash (-)
        //     or a dot (.), then the European d-m-y format is assumed."
        //
        // @see: http://php.net/manual/en/function.strtotime.php
        if ($countryCode !== 'US') {
            $time = str_replace('/', '-', $time);
        } else {
            $time = str_replace('-', '/', $time);
            $time = str_replace('.', '/', $time);
        }

        return $time;
    }

    /**
     * Validate a given date. Based on Laravel's built-in `date` validator.
     * @see \Illuminate\Validation\Validator validateDate()
     *
     * @param string $value - Date (to be validated)
     * @param string $countryCode - Optionally, override country code
     * @return bool
     */
    public static function validate($value, $countryCode = null)
    {
        if ($value instanceof DateTime) {
            return true;
        }

        // Before validating, normalize strings by country code.
        $value = static::normalize($value, $countryCode);

        if (strtotime($value) === false) {
            return false;
        }

        $date = date_parse($value);

        return checkdate($date['month'], $date['day'], $date['year']);
    }
}
