<?php

return [
    "api" => [
        "message" => [
            "success" => "通信に成功しました。",
            "failure" => "通信に失敗しました。",
        ],
    ],
    "calendar" => [
        "class" => [
            "calendar"  => "calendar",
            "table"     => "table table-bordered",
            "day"       => "calendar-cell position-relative",
            "saturday"  => "table-primary",
            "sunday"    => "table-danger",
            "out_range" => "table-active invalid",
            "event"     => "calendar-event rounded px-1 position-relative",
        ],
    ],
    "date" => [
        "data" => [
            "zero_date"      => "0000-00-00",
            "time_day_start" => "00:00:00",
            "time_day_end"   => "23:59:59",
        ],
        "format" => [
            "datetime"       => "Y-m-d H:i:s",
            "date"           => "Y-m-d",
            "date_short"     => "Ymd",
            "year_month"     => "Y-m",
            "month_day"      => "m-d",
            "time"           => "H:i:s",
            "hour_minute"    => "H:i",

            "datetime_jp"    => "Y年n月j日 G時i分s秒",
            "date_jp"        => "Y年n月j日",
            "year_month_jp"  => "Y年n月",
            "month_day_jp"   => "n月j日",
            "time_jp"        => "G時i分s秒",
            "hour_minute_jp" => "G時i分",
        ]
    ],
    "event" => [
        "log" => env("LIBRARY_EVENT_LOG", false),
    ],
    "file" => [
        "character_code" => [
            'UTF-8',
            'eucJP-win',
            'SJIS-win',
            'ASCII',
            'EUC-JP',
            'SJIS',
            'JIS',
        ],
    ],
];
