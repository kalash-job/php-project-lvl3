<?php

namespace App\Helpers;

/*use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;*/

class Helpers
{
    public static function getClassActive(string $routeName): string
    {
        return \Route::is($routeName) ? ' active' : '';
    }
}
