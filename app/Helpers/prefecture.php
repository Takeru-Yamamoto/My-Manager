<?php

use App\Consts\PrefectureConst;

if (!function_exists('isPrefecture')) {
    function isPrefecture(string $prefecture): bool
    {
        return isset(PrefectureConst::PREFECTURES[$prefecture]);
    }
}

if (!function_exists('upperCasePrefecture')) {
    function upperCasePrefecture(string $prefecture): string
    {
        if (!isPrefecture($prefecture)) return "";

        return PrefectureConst::PREFECTURES_UPPER_CASE[$prefecture];
    }
}

if (!function_exists('kanjiPrefecture')) {
    function kanjiPrefecture(string $prefecture): string
    {
        if (!isPrefecture($prefecture)) return "";

        return PrefectureConst::PREFECTURES_KANJI[$prefecture];
    }
}

if (!function_exists('fullKanjiPrefecture')) {
    function fullKanjiPrefecture(string $prefecture): string
    {
        if (!isPrefecture($prefecture)) return "";

        return PrefectureConst::PREFECTURES_FULL_KANJI[$prefecture];
    }
}

if (!function_exists('isRegion')) {
    function isRegion(string $region): bool
    {
        return isset(PrefectureConst::REGIONS[$region]);
    }
}

if (!function_exists('upperCaseRegion')) {
    function upperCaseRegion(string $region): string
    {
        if (!isRegion($region)) return "";

        return PrefectureConst::REGIONS_UPPER_CASE[$region];
    }
}

if (!function_exists('kanjiRegion')) {
    function kanjiRegion(string $region): string
    {
        if (!isRegion($region)) return "";

        return PrefectureConst::REGIONS_KANJI[$region];
    }
}

if (!function_exists('convertToRegionFromPrefecture')) {
    function convertToRegionFromPrefecture(string $prefecture): string
    {
        if (!isPrefecture($prefecture)) return "";

        return PrefectureConst::PREFECTURES_REGIONS[$prefecture];
    }
}
