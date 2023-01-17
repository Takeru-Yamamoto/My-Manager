<?php

namespace App\Consts;

class DayOfWeekConst
{
    public const DAY_OF_WEEK = [
        "sunday",
        "monday",
        "tuesday",
        "wednesday",
        "thursday",
        "friday",
        "saturday",
    ];

    public const DAY_OF_WEEK_UPPER_CASE = [
        self::DAY_OF_WEEK[0] => "Sunday",
        self::DAY_OF_WEEK[1] => "Monday",
        self::DAY_OF_WEEK[2] => "Tuesday",
        self::DAY_OF_WEEK[3] => "Wednesday",
        self::DAY_OF_WEEK[4] => "Thursday",
        self::DAY_OF_WEEK[5] => "Friday",
        self::DAY_OF_WEEK[6] => "Saturday",
    ];

    public const DAY_OF_WEEK_SHORT = [
        self::DAY_OF_WEEK[0] => "sun",
        self::DAY_OF_WEEK[1] => "mon",
        self::DAY_OF_WEEK[2] => "tue",
        self::DAY_OF_WEEK[3] => "wed",
        self::DAY_OF_WEEK[4] => "thu",
        self::DAY_OF_WEEK[5] => "fri",
        self::DAY_OF_WEEK[6] => "sat",
    ];

    public const DAY_OF_WEEK_UPPER_CASE_SHORT = [
        self::DAY_OF_WEEK[0] => "Sun",
        self::DAY_OF_WEEK[1] => "Mon",
        self::DAY_OF_WEEK[2] => "Tue",
        self::DAY_OF_WEEK[3] => "Wed",
        self::DAY_OF_WEEK[4] => "Thu",
        self::DAY_OF_WEEK[5] => "Fri",
        self::DAY_OF_WEEK[6] => "Sat",
    ];

    public const DAY_OF_WEEK_KANJI = [
        self::DAY_OF_WEEK[0] => "日",
        self::DAY_OF_WEEK[1] => "月",
        self::DAY_OF_WEEK[2] => "火",
        self::DAY_OF_WEEK[3] => "水",
        self::DAY_OF_WEEK[4] => "木",
        self::DAY_OF_WEEK[5] => "金",
        self::DAY_OF_WEEK[6] => "土",
    ];

    public const DAY_OF_WEEK_KANJI_FULL = [
        self::DAY_OF_WEEK[0] => "日曜日",
        self::DAY_OF_WEEK[1] => "月曜日",
        self::DAY_OF_WEEK[2] => "火曜日",
        self::DAY_OF_WEEK[3] => "水曜日",
        self::DAY_OF_WEEK[4] => "木曜日",
        self::DAY_OF_WEEK[5] => "金曜日",
        self::DAY_OF_WEEK[6] => "土曜日",
    ];
}
