<?php

namespace App\Consts;

use App\Consts\RoleConst;

class ContentConst
{
    public const USER       = "user";
    public const LOGIN_INFO = "login_info";
    public const ATTENDANCE = "attendance";
    public const TASK       = "task";
    public const TASK_COLOR = "task_color";

    public const IS_TITLE = "管理";
    public const IS_TABLE = "一覧";

    public const PAGES = [
        self::LOGIN_INFO => [
            "title" => "ログイン情報",
            "url"   => self::LOGIN_INFO,
            "icon"  => "fa-solid fa-gear",
            "can"   => RoleConst::USER_HIGHER,
        ],
        self::USER => [
            "title" => "ユーザー",
            "url"   => self::USER,
            "icon"  => "fa-solid fa-user",
            "can"   => RoleConst::ADMIN_HIGHER,
        ],
        self::ATTENDANCE => [
            "title" => "勤怠",
            "url"   => self::ATTENDANCE,
            "icon"  => "fa-solid fa-clock",
            "can"   => RoleConst::USER_HIGHER,
        ],
        self::TASK => [
            "title" => "タスク",
            "url"   => self::TASK,
            "icon"  => "fa-solid fa-calendar-days",
            "can"   => RoleConst::USER_HIGHER,
        ],
    ];
}
