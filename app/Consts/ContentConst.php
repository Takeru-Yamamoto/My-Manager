<?php

namespace App\Consts;

use App\Consts\GateConst;

class ContentConst
{
    public const USER       = "user";
    public const LOGIN_INFO = "login_info";
    public const ATTENDANCE = "attendance";
    public const TASK       = "task";
    public const TASK_COLOR = "task_color";

    public const USER_URL       = self::USER;
    public const LOGIN_INFO_URL = self::LOGIN_INFO;
    public const ATTENDANCE_URL = self::ATTENDANCE;
    public const TASK_URL       = self::TASK;
    public const TASK_COLOR_URL = self::TASK_COLOR;

    public const USER_TITLE       = "ユーザー";
    public const LOGIN_INFO_TITLE = "ログイン情報";
    public const ATTENDANCE_TITLE = "勤怠";
    public const TASK_TITLE       = "タスク";
    public const TASK_COLOR_TITLE = "タスク色";

    public const IS_TITLE = "管理";
    public const IS_TABLE = "一覧";

    public const TITLES  = [
        self::USER       => self::USER_TITLE,
        self::LOGIN_INFO => self::LOGIN_INFO_TITLE,
        self::ATTENDANCE => self::ATTENDANCE_TITLE,
        self::TASK       => self::TASK_TITLE,
        self::TASK_COLOR => self::TASK_COLOR_TITLE,
    ];

    public const URLS    = [
        self::USER       => self::USER_URL,
        self::LOGIN_INFO => self::LOGIN_INFO_URL,
        self::ATTENDANCE => self::ATTENDANCE_URL,
        self::TASK       => self::TASK_URL,
        self::TASK_COLOR => self::TASK_COLOR_URL,
    ];

    public const SIDEBARS = [
        GateConst::SYSTEM => [
            self::USER,
            self::ATTENDANCE,
            self::TASK,
        ],
        GateConst::ADMIN => [
            self::LOGIN_INFO,
            self::USER,
            self::TASK,
        ],
        GateConst::USER => [
            self::LOGIN_INFO,
            self::ATTENDANCE,
            self::TASK,
        ],
        GateConst::GUEST => [
        ],
    ];

    public const SIDEBAR_ICONS = [
        self::USER       => "fa-solid fa-user",
        self::LOGIN_INFO => "fa-solid fa-gear",
        self::ATTENDANCE => "fa-solid fa-clock",
        self::TASK       => "fa-solid fa-calendar-days",
    ];

    public const SIDEBAR_CLASSES = [
        GateConst::SYSTEM => [],
        GateConst::ADMIN  => [],
        GateConst::USER   => [],
        GateConst::GUEST  => [],
    ];
}
