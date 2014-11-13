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

function format_date_for_save($date)
{
  return date('Y-m-d',(strtotime($date)));
}

function formate_date_for_view($date)
{
  return date('m-d-Y',(strtotime($date)));
}