<?php

use \Illuminate\Support\Facades\Log;

if (!function_exists('mapTextForLog')) {
    function mapTextForLog(string $key, string $value): string
    {
        return $key . " => " . $value;
    }
}
if (!function_exists('debugLog')) {
    function debugLog(string $message): void
    {
        Log::debug($message);
    }
}
if (!function_exists('alertLog')) {
    function alertLog(string $message): void
    {
        Log::alert($message);
    }
}
if (!function_exists('infoLog')) {
    function infoLog(string $message): void
    {
        Log::info($message);
    }
}
if (!function_exists('emergencyLog')) {
    function emergencyLog(string $message): void
    {
        Log::emergency($message);
    }
}
if (!function_exists('errorLog')) {
    function errorLog(string $message): void
    {
        Log::error($message);
    }
}
if (!function_exists('emptyLog')) {
    function emptyLog(): void
    {
        infoLog("");
    }
}
if (!function_exists('dividerLog')) {
    function dividerLog(): void
    {
        emptyLog();
        infoLog("===========================");
        emptyLog();
    }
}
if (!function_exists('emphasisLog')) {
    function emphasisLog(string $message): void
    {
        infoLog("===== " . $message . " =====");
    }
}
if (!function_exists('littleEmphasisLog')) {
    function littleEmphasisLog(string $message): void
    {
        infoLog("  === " . $message . " ===  ");
    }
}
if (!function_exists('mapLog')) {
    function mapLog(string $key, string $value): void
    {
        infoLog(mapTextForLog($key, $value));
    }
}
if (!function_exists('emphasisMapLog')) {
    function emphasisMapLog(string $key, string $value): void
    {
        emphasisLog(mapTextForLog($key, $value));
    }
}
if (!function_exists('littleEmphasisMapLog')) {
    function littleEmphasisMapLog(string $key, string $value): void
    {
        littleEmphasisLog(mapTextForLog($key, $value));
    }
}
if (!function_exists('emphasisLogStart')) {
    function emphasisLogStart(string $type): void
    {
        emptyLog();
        emphasisLog($type . " START");
        emptyLog();
    }
}
if (!function_exists('emphasisLogEnd')) {
    function emphasisLogEnd(string $type): void
    {
        emptyLog();
        emphasisLog($type . " END");
        emptyLog();
    }
}
if (!function_exists('littleEmphasisLogStart')) {
    function littleEmphasisLogStart(string $type): void
    {
        emptyLog();
        littleEmphasisLog($type . " START");
        emptyLog();
    }
}
if (!function_exists('littleEmphasisLogEnd')) {
    function littleEmphasisLogEnd(string $type): void
    {
        emptyLog();
        littleEmphasisLog($type . " END");
        emptyLog();
    }
}
if (!function_exists('checkLog')) {
    function checkLog(string $check): void
    {
        emptyLog();
        emphasisLog("check : " . $check);
        emptyLog();
    }
}
if (!function_exists('jsonCheckLog')) {
    function jsonCheckLog(mixed $check): void
    {
        checkLog(json_encode($check, JSON_UNESCAPED_UNICODE));
    }
}
if (!function_exists('checkMapLog')) {
    function checkMapLog(string $key, string $value): void
    {
        checkLog(mapTextForLog($key, $value));
    }
}
if (!function_exists('checkLogStart')) {
    function checkLogStart(string $type): void
    {
        emptyLog();
        emphasisLog("CHECK LOG START TYPE OF : " . $type);
        emptyLog();
    }
}
if (!function_exists('checkLogEnd')) {
    function checkLogEnd(): void
    {
        emptyLog();
        emphasisLog("CHECK LOG END");
        emptyLog();
    }
}
