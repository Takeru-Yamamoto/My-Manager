<?php

namespace App\Http\Gates;

use Illuminate\Support\Facades\Gate;
use App\Consts\RoleConst;

class ApiGate
{
    public static function define()
    {
        Gate::define(RoleConst::API_ACCESS, function ($user = null) {
            return checkAccessToken(request()->header(RoleConst::API_ACCESS_TOKEN_HEADER));
        });
    }
}
