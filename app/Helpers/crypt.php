<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

if (!function_exists('encryptParams')) {
    function encryptParams(array $params): string
    {
        return encrypt($params);
    }
}
if (!function_exists('decryptParams')) {
    function decryptParams(string $encrypted): array
    {
        try {
            $decrypt = decrypt($encrypted);
            return is_array($decrypt) ? $decrypt : [];
        } catch (\Exception $ex) {
            return [];
        }
    }
}
if (!function_exists('createRandomNumber')) {
    function createRandomNumber(int $digit): string
    {
        return sprintf('%0' . $digit . 'd', random_int(0, pow(10, $digit) - 1));
    }
}
if (!function_exists('makeHash')) {
    function makeHash(string $text): string
    {
        return Hash::make($text);
    }
}
if (!function_exists('checkHash')) {
    function checkHash(string $text, string $hashedText): bool
    {
        return Hash::check($text, $hashedText);
    }
}
if (!function_exists('hashedRandomText')) {
    function hashedRandomText(int $length = 16): string
    {
        return makeHash(Str::random($length));
    }
}
if (!function_exists('hashedAccessToken')) {
    function hashedAccessToken(): string
    {
        return makeHash(config("application.api_access_token"));
    }
}
if (!function_exists('checkAccessToken')) {
    function checkAccessToken($accessToken): bool
    {
        return checkHash(config("application.api_access_token"), $accessToken);
    }
}
if (!function_exists('expirationDate')) {
    function expirationDate(int $minute): string
    {
        return dateUtil()->addMinute($minute)->toDateTimeString();
    }
}
