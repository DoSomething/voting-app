<?php

/**
 * Return contents of Fastly's GeoIP country code header.
 *
 * @return string - Country Code, or '?' if header is not set.
 */
function get_country_code()
{
    return app('request')->server('HTTP_X_FASTLY_COUNTRY_CODE', '?');
}

/**
 * Return if the user is a domestic (US) session.
 *
 * $return boolean
 */
function is_domestic_session()
{
    return get_country_code() === 'US';
}

/**
 * Return if the user is an international session.
 *
 * $return boolean
 */
function is_international_session()
{
    return get_country_code() !== 'US';
}

/**
 * Generate a Twitter tweet web intent.
 * @param $text    String  Text for tweet, with TWITTER_NAME placeholder for twitter handle
 * @param $url     String  URL to attach to tweet
 * @param $twitter String  (optional) Text to replace TWITTER_NAME placeholder with.
 * @return string
 */
function tweet_intent($text, $url, $twitter = null)
{
    if (!is_null($twitter)) {
        $text = str_replace('TWITTER_NAME', $twitter, $text);
    }

    return 'https://twitter.com/intent/tweet?text=' . urlencode($text) . '&url=' . urlencode($url);
}

/**
 * Generate a Facebook web intent.
 */
function facebook_intent($url)
{
    return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url);
}

/**
 * Generate relative links for sorting tabular data.
 * @param $column string Column to sort by
 * @return string
 */
function sort_url($column)
{
    $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';
    return '?sort_by=' . e($column) . '&direction=' . e($direction);
}

/**
 * Return a class to indicate the current sorting method.
 * @param $column Column to indicate sorting status of
 * @return string
 */
function sort_class($column)
{
    $sortColumn = Request::get('sort_by');
    $sortClass = (Request::get('direction') == 'asc') ? 'is-sorted-asc' : 'is-sorted-desc';

    if($column !== $sortColumn) return '';

    return $sortClass;
}

/**
 * Get a setting value, or use a default if unset.
 *
 * @param string $setting - Setting key
 * @param mixed $fallback - Setting fallback, if unset
 * @return mixed
 */
function setting($setting, $fallback = null)
{
    $repository = app()->make('VotingApp\Repositories\SettingsRepository');
    return $repository->get($setting, $fallback);
}

/**
 * Get a random background image from the Backgrounds model.
 *
 * @param string $type - 'retina', 'regular', or 'thumbnail'
 * @param string $fallback - Fallback image, if no custom backgrounds set
 * @return string
 */
function background($type, $fallback)
{
    $repository = app()->make('VotingApp\Repositories\BackgroundsRepository');
    return $repository->random($type, $fallback);
}
