<?php

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;


if (! function_exists('currentUser')) {
    function currentUser(): Authenticatable
    {
        return auth()->user();
    }
}


if (! function_exists('activeClass')) {
    function activeClass($route, $class = 'active', $subAccount = false)
    {
        if ($subAccount) { //  Matching Route by Name Use For parent menu
            return request()->is($route) ? $class : '';
        }

        return request()->routeIs($route) ? $class : '';
    }
}


