<?php

return [
    "expiration_minute" => 30,

    "subject_head" => "[Laravel CMS]",

    "subject" => [
        "systemAlert"    => "System Alert",
        "passwordForgot" => "パスワード変更のお知らせ",
        "emailReset"     => "メールアドレス変更のお知らせ",
    ],

    "system_alert" => [
        "from" => [
            "address" => env("SYSTEM_ALERT_FROM_ADDRESS"),
            "name"    => env("SYSTEM_ALERT_FROM_NAME")
        ],
        "to" => [
            "address" => env("SYSTEM_ALERT_TO_ADDRESS")
        ]
    ]
];
