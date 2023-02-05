<?php

if (!function_exists('isPrefecture')) {
    function isPrefecture(string $prefecture): bool
    {
        return isset(config("prefecture.list")[$prefecture]);
    }
}
if (!function_exists('upperCasePrefecture')) {
    function upperCasePrefecture(string $prefecture): string
    {
        return isPrefecture($prefecture) ? config("prefecture.upper_case")[$prefecture] : "";
    }
}
if (!function_exists('kanjiPrefecture')) {
    function kanjiPrefecture(string $prefecture): string
    {
        return isPrefecture($prefecture) ? config("prefecture.kanji")[$prefecture] : "";
    }
}
if (!function_exists('fullKanjiPrefecture')) {
    function fullKanjiPrefecture(string $prefecture): string
    {
        return isPrefecture($prefecture) ? config("prefecture.kanji_full")[$prefecture] : "";
    }
}
if (!function_exists('isRegion')) {
    function isRegion(string $region): bool
    {
        return isset(config("prefecture.region")[$region]);
    }
}
if (!function_exists('upperCaseRegion')) {
    function upperCaseRegion(string $region): string
    {
        return isRegion($region) ? config("prefecture.region_upper_case")[$region] : "";
    }
}
if (!function_exists('kanjiRegion')) {
    function kanjiRegion(string $region): string
    {
        return isRegion($region) ? config("prefecture.region_kanji")[$region] : "";
    }
}
if (!function_exists('convertToRegionFromPrefecture')) {
    function convertToRegionFromPrefecture(string $prefecture): string
    {
        return isPrefecture($prefecture) ? config("prefecture.prefecture_region")[$prefecture] : "";
    }
}
