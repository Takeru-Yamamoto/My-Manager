<?php

use App\Library;
use Carbon\Carbon;

if (!function_exists('apiUtil')) {
    function apiUtil(string $url, array $params = array()): Library\APIUtil
    {
        return new Library\APIUtil($url, $params);
    }
}

if (!function_exists('calendarUtil')) {
    function calendarUtil(Carbon $carbon = null): Library\CalendarUtil
    {
        return new Library\CalendarUtil($carbon);
    }
}

if (!function_exists('dateUtil')) {
    function dateUtil(mixed $any = null): Library\DateUtil
    {
        return new Library\DateUtil($any);
    }
}

if (!function_exists('eventUtil')) {
    function eventUtil(): Library\EventUtil
    {
        return new Library\EventUtil();
    }
}

if (!function_exists('fileUtil')) {
    function fileUtil(): Library\FileUtil
    {
        return new Library\FileUtil();
    }
}

if (!function_exists('timeUtil')) {
    function timeUtil(string $method): Library\TimeUtil
    {
        return new Library\TimeUtil($method);
    }
}
