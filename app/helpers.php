<?php

use Illuminate\Html\FormBuilder;
use Illuminate\Html\HtmlBuilder;


FormBuilder::macro('error', function($field, $errors)
{
  return $errors->first($field, '<span class="validation error">:message</span>');
});

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
