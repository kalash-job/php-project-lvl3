<?php

namespace App\Helpers;

class Helpers
{
    public static function getClassActive(string $routeName): string
    {
        return \Route::is($routeName) ? ' active' : '';
    }
}
