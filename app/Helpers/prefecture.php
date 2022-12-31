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
