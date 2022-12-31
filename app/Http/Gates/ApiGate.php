<?php

namespace App\Http\Gates;

use Illuminate\Support\Facades\Gate;
use App\Consts\GateConst;

class ApiGate
{
    private const API_ACCESS_TOKEN_HEADER = "X-API-Access-Token";

    public static function define()
    {
        Gate::define(GateConst::API_ACCESS, function ($user = null) {
            return checkAccessToken(request()->header(self::API_ACCESS_TOKEN_HEADER));
        });
    }
}
