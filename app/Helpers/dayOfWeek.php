<?php

if (!function_exists('isDayOdWeek')) {
    function isDayOdWeek(string $dayOfWeek): bool
    {
        return isset(config("dayOfWeek.list")[$dayOfWeek]);
    }
}
if (!function_exists('upperCaseDayOfWeek')) {
    function upperCaseDayOfWeek(string $dayOfWeek): string
    {
        return isDayOdWeek($dayOfWeek) ? config("dayOfWeek.upper_case")[$dayOfWeek] : "";
    }
}
if (!function_exists('shortDayOfWeek')) {
    function shortDayOfWeek(string $dayOfWeek): string
    {
        return isDayOdWeek($dayOfWeek) ? config("dayOfWeek.short")[$dayOfWeek] : "";
    }
}
if (!function_exists('shortUpperCaseDayOfWeek')) {
    function shortUpperCaseDayOfWeek(string $dayOfWeek): string
    {
        return isDayOdWeek($dayOfWeek) ? config("dayOfWeek.upper_case_short")[$dayOfWeek] : "";
    }
}
if (!function_exists('kanjiDayOfWeek')) {
    function kanjiDayOfWeek(string $dayOfWeek): string
    {
        return isDayOdWeek($dayOfWeek) ? config("dayOfWeek.kanji")[$dayOfWeek] : "";
    }
}
if (!function_exists('fullKanjiDayOfWeek')) {
    function fullKanjiDayOfWeek(string $dayOfWeek): string
    {
        return isDayOdWeek($dayOfWeek) ? config("dayOfWeek.kanji_full")[$dayOfWeek] : "";
    }
}
