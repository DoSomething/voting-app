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
function highlighted_link_to_route($route, $text, $params, $activeClass = '-is-active')
{
  $url = route($route, $params);

  $class = '';
  if(Request::url() == $url) {
    $class = $activeClass;
  }

  return link_to_route($route, $text, $params, ['class' => $class]);
};

function get_country_code()
{
  return Request::server('HTTP_X_FASTLY_COUNTRY_CODE');

}

function get_login_type()
{
  $type = 'user_phone';
  $country_code = get_country_code();
  if (isset($country_code) && $country_code != 'US') {
    $type = 'user_email';
  }
  return $type;
}