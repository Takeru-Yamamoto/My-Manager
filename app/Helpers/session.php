<?php

if (!function_exists('sessionHas')) {
    function sessionHas(string $key): bool
    {
        return session()->has($key);
    }
}

if (!function_exists('sessionHasNot')) {
    function sessionHasNot(string $key): bool
    {
        return session()->missing($key);
    }
}

if (!function_exists('sessionHasNullable')) {
    function sessionHasNullable(string $key): bool
    {
        return session()->exists($key);
    }
}

if (!function_exists('sessionAll')) {
    function sessionAll(): mixed
    {
        return session()->all();
    }
}

if (!function_exists('sessionGet')) {
    function sessionGet(string|array $key, mixed $default = null): mixed
    {
        if (is_array($key)) $key = implode(".", $key);
        return session($key, $default);
    }
}

if (!function_exists('sessionGetRemove')) {
    function sessionGetRemove(string|array $key, mixed $default = null): mixed
    {
        if (is_array($key)) $key = implode(".", $key);
        return session()->pull($key, $default);
    }
}

if (!function_exists('sessionSet')) {
    function sessionSet(string $key, mixed $value): void
    {
        session([$key => $value]);
    }
}

if (!function_exists('sessionIncrement')) {
    function sessionIncrement(string $key, ?int $amount = 1): void
    {
        session()->increment($key, $amount);
    }
}

if (!function_exists('sessionDecrement')) {
    function sessionDecrement(string $key, ?int $amount = 1): void
    {
        session()->decrement($key, $amount);
    }
}

if (!function_exists('sessionRemove')) {
    function sessionRemove(string|array $key): void
    {
        session()->forget($key);
    }
}

if (!function_exists('sessionRemoveAll')) {
    function sessionRemoveAll(): void
    {
        session()->flush();
    }
}