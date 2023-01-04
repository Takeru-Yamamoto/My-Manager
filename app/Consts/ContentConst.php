<?php

namespace App\Consts;

use App\Consts\GateConst;

class ContentConst
{
    public const USER       = "user";
    public const PROFILE    = "profile";
    public const LOGIN_INFO = "login_info";
    public const ATTENDANCE = "attendance";
    public const TASK       = "task";

    public const USER_URL       = self::USER;
    public const PROFILE_URL    = self::PROFILE;
    public const LOGIN_INFO_URL = self::LOGIN_INFO;
    public const ATTENDANCE_URL = self::ATTENDANCE;
    public const TASK_URL       = self::TASK;

    public const USER_TITLE       = "ユーザー情報";
    public const PROFILE_TITLE    = "プロフィール情報";
    public const LOGIN_INFO_TITLE = "ログイン情報";
    public const ATTENDANCE_TITLE = "勤怠情報";
    public const TASK_TITLE       = "タスク情報";

    public const IS_TITLE = "管理";
    public const IS_TABLE = "一覧";

    public const TITLES  = [
        self::USER       => self::USER_TITLE,
        self::PROFILE    => self::PROFILE_TITLE,
        self::LOGIN_INFO => self::LOGIN_INFO_TITLE,
        self::ATTENDANCE => self::ATTENDANCE_TITLE,
        self::TASK       => self::TASK_TITLE,
    ];

    public const URLS    = [
        self::USER       => self::USER_URL,
        self::PROFILE    => self::PROFILE_URL,
        self::LOGIN_INFO => self::LOGIN_INFO_URL,
        self::ATTENDANCE => self::ATTENDANCE_URL,
        self::TASK       => self::TASK_URL,
    ];

    public const SIDEBARS = [
        GateConst::SYSTEM => [
            self::USER,
        ],
        GateConst::ADMIN => [
            self::LOGIN_INFO,
            self::PROFILE,
            self::USER,
        ],
        GateConst::USER => [
            self::LOGIN_INFO,
            self::PROFILE,
            self::ATTENDANCE,
            self::TASK,
        ],
    ];

    public const BOOTSTRAP_COLORS = [
        "blue",
        "indigo",
        "purple",
        "pink",
        "red",
        "orange",
        "yellow",
        "green",
        "teal",
        "cyan",
        "black",
        "white",
    ];

    public const BOOTSTRAP_COLOR_CODES = [
        "blue"   => "#0d6efd",
        "indigo" => "#6610f2",
        "purple" => "#6f42c1",
        "pink"   => "#d63384",
        "red"    => "#dc3545",
        "orange" => "#fd7e14",
        "yellow" => "#ffc107",
        "green"  => "#198754",
        "teal"   => "#20c997",
        "cyan"   => "#0dcaf0",
        "black"  => "#000000",
        "white"  => "#ffffff",

        "gray-100"  => "#f8f9fa",
        "gray-200"  => "#e9ecef",
        "gray-300"  => "#dee2e6",
        "gray-400"  => "#ced4da",
        "gray-500"  => "#adb5bd",
        "gray-600"  => "#6c757d",
        "gray-700"  => "#495057",
        "gray-800"  => "#343a40",
        "gray-900"  => "#212529",
    ];

    public const BOOTSTRAP_CLASS_COLORS = [
        "primary"   => "blue",
        "secondary" => "gray-600",
        "success"   => "green",
        "info"      => "cyan",
        "warning"   => "yellow",
        "danger"    => "red",
        "light"     => "gray-100",
        "dark"      => "gray-900",
    ];
}
