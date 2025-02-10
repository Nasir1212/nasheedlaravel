<?php

if (!function_exists('isActive')) {
    function isActive($routeName)
    {
        return Route::is($routeName) ? 'active' : '';
    }
}
