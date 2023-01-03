<?php

namespace App\Consts;

class GateConst
{
    /* Gate処理はApp\Providers\AuthServiceProvider */

    public const SYSTEM        = "system";
    public const ADMIN         = "admin";
    public const USER          = "user";

    public const ADMIN_HIGHER  = "admin-higher";
    public const USER_HIGHER   = "user-higher";

    public const SYSTEM_NUMBER = 1;
    public const ADMIN_NUMBER  = 5;
    public const USER_NUMBER   = 10;

    public const ROLES = [
        self::SYSTEM => self::SYSTEM_NUMBER,
        self::ADMIN  => self::ADMIN_NUMBER,
        self::USER   => self::USER_NUMBER,
    ];

    /* api */
    public const API_ACCESS = "api-access";
}