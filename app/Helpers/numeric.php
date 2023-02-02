<?php

if (!function_exists('squared')) {
    function squared(int|float $num): int|float|object
    {
        return pow($num, 2);
    }
}
if (!function_exists('cubed')) {
    function cubed(int|float $num): int|float|object
    {
        return pow($num, 3);
    }
}
if (!function_exists('isPrime')) {
    function isPrime(int $num): bool
    {
        /* 1以下 */
        if ($num <= 1) return false;

        /* 2以外の偶数 */
        if ($num !== 2 && $num % 2 === 0) return false;

        /* 平方根が整数 */
        if (is_int(sqrt($num))) return false;

        $max = floor(sqrt($num));
        for ($i = 3; $i <= $max; $i += 2) {
            if ($num % $i == 0) {
                return false;
            }
        }
        return true;
    }
}
if (!function_exists('fibonacci')) {
    function fibonacci(int $num): int
    {
        return 1 / sqrt(5) * (((1 + sqrt(5)) / 2) ** $num - ((1 - sqrt(5)) / 2) ** $num);
    }
}