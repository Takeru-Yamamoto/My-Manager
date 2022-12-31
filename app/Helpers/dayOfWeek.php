<?php

use App\Consts\DayOfWeekConst;

if (!function_exists('isDayOdWeek')) {
    function isDayOdWeek(string $dayOfWeek): bool
    {
        return isset(DayOfWeekConst::DAY_OF_WEEK[$dayOfWeek]);
    }
}

if (!function_exists('upperCaseDayOfWeek')) {
    function upperCaseDayOfWeek(string $dayOfWeek): string
    {
        if (!isDayOdWeek($dayOfWeek)) return "";

        return DayOfWeekConst::DAY_OF_WEEK_UPPER_CASE[$dayOfWeek];
    }
}

if (!function_exists('shortDayOfWeek')) {
    function shortDayOfWeek(string $dayOfWeek): string
    {
        if (!isDayOdWeek($dayOfWeek)) return "";

        return DayOfWeekConst::DAY_OF_WEEK_SHORT[$dayOfWeek];
    }
}

if (!function_exists('shortUpperCaseDayOfWeek')) {
    function shortUpperCaseDayOfWeek(string $dayOfWeek): string
    {
        if (!isDayOdWeek($dayOfWeek)) return "";

        return DayOfWeekConst::DAY_OF_WEEK_UPPER_CASE_SHORT[$dayOfWeek];
    }
}

if (!function_exists('kanjiDayOfWeek')) {
    function kanjiDayOfWeek(string $dayOfWeek): string
    {
        if (!isDayOdWeek($dayOfWeek)) return "";

        return DayOfWeekConst::DAY_OF_WEEK_KANJI[$dayOfWeek];
    }
}

if (!function_exists('fullKanjiDayOfWeek')) {
    function fullKanjiDayOfWeek(string $dayOfWeek): string
    {
        if (!isDayOdWeek($dayOfWeek)) return "";

        return DayOfWeekConst::DAY_OF_WEEK_KANJI_FULL[$dayOfWeek];
    }
}