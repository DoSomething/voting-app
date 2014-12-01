<?php

/**
 * Displays form errors.
 */
function form_error($field, $errors)
{
  return $errors->first($field, '<span class="validation error">:message</span>');
}

/**
 * Add an active class to current page's menu item.
 */
function highlighted_link_to_route($route, $text, $params = [], $forceOnPath = null)
{
  $url = route($route, $params);

  $class = '';
  if(Request::url() == $url || Request::path() == $forceOnPath) {
    $class = 'is-active';
  }

  return link_to_route($route, $text, $params, ['class' => $class]);
};

/**
 * Return contents of Fastly's GeoIP country code header.
 * @return string|null Country Code, or null if header is not set.
 */
function get_country_code()
{
  return (Request::server('HTTP_X_FASTLY_COUNTRY_CODE')) ? Request::server('HTTP_X_FASTLY_COUNTRY_CODE') : 'US';
}

/**
 * Determine which field to show in user form. Domestic users should
 * see phone field, and international users should see email field.
 */
function get_login_type()
{
  $type = 'phone';
  $country_code = get_country_code();

  // If user is not in the US, ask for their email instead.
  if (isset($country_code) && $country_code != 'US') {
    $type = 'email';
  }

  return $type;
}

/**
 * Generate a Twitter tweet web intent.
 */
function tweet_intent($text, $url)
{
  return 'https://twitter.com/intent/tweet?text=' . urlencode($text) . '&url=' . urlencode($url);
}

/**
 * Generate a Facebook web intent.
 */
function facebook_intent($url)
{
  return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url);
}
