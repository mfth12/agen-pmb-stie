<?php

if (!function_exists('user_can')) {
  function user_can($permission)
  {
    return auth()->check() && auth()->user()->can($permission);
  }
}

if (!function_exists('user_has_role')) {
  function user_has_role($role)
  {
    return auth()->check() && auth()->user()->hasRole($role);
  }
}
