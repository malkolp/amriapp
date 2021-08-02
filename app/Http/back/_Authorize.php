<?php


namespace App\Http\back;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class _Authorize
{
    public static function login(): bool {
        return Auth::check();
    }

    public static function data(): ?Authenticatable {
        return Auth::user();
    }
}
