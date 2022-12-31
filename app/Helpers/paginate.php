<?php

use Illuminate\Pagination\LengthAwarePaginator;

if (!function_exists('pageOffset')) {
    function pageOffset(int $page, int $limit): int
    {
        return ($page - 1) * $limit;
    }
}

if (!function_exists('paginator')) {
    function paginator(array $items, int $total, int $limit, string $path, int $page, array $options = []): LengthAwarePaginator
    {
        $options["path"] = $path;

        return new LengthAwarePaginator($items, $total, $limit, $page, $options);
    }
}
