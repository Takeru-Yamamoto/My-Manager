<?php

use App\Library;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

if (!function_exists('requestFileUtil')) {
    function requestFileUtil(Request $request, string $fileName, ?string $additionalUploadDirectory, ?string $registerName): Library\RequestFileUtil
    {
        return new Library\RequestFileUtil($request, $fileName, $additionalUploadDirectory, $registerName);
    }
}

if (!function_exists('timeUtil')) {
    function timeUtil(string $method): Library\TimeUtil
    {
        return new Library\TimeUtil($method);
    }
}
