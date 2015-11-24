<?php

namespace VotingApp;

use Carbon\Carbon;

class LocalizedDate extends Carbon {

    public function __construct($time = null, $timezone = null)
    {
        if(get_country_code() !== 'US') {
            $time = str_replace('/', '-', $time);
        }

        parent::__construct($time, $timezone);
    }

    /**
     * Get expected date format by current session's country code.
     *
     * @return string
     */
    public static function getExpectedFormat()
    {
        return get_country_code() === 'US' ? 'MM/DD/YYYY' : 'DD/MM/YYYY';
    }

    /**
     * Validate a given date. Based on Laravel's built-in `date` validator.
     * @see \Illuminate\Validation\Validator validateDate()
     *
     * @param $value
     * @return bool
     */
    public static function validate($value) {
        if ($value instanceof DateTime) {
            return true;
        }

        if(get_country_code() !== 'US') {
            $value = str_replace('/', '-', $value);
        }

        if (strtotime($value) === false) {
            return false;
        }

        $date = date_parse($value);

        return checkdate($date['month'], $date['day'], $date['year']);
    }

}
