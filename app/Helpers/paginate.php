<?php

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\BaseRepository;

if (!function_exists('pageOffset')) {
    function pageOffset(int $page, int $limit): int
    {
        return ($page - 1) * $limit;
    }
}

if (!function_exists('paginatorPath')) {
    function paginatorPath(): string
    {
        $path = request()->path();

        if (strpos($path, "/") === false) return $path;

        $path = explode("/", $path);

        return end($path);
    }
}

if (!function_exists('paginator')) {
    function paginator(array $items, int $total, int $limit, int $page, array $options = []): LengthAwarePaginator
    {
        if (!isset($options["path"])) $options["path"] = paginatorPath();

        return new LengthAwarePaginator($items, $total, $limit, $page, $options);
    }
}

if (!function_exists('paginatorByRepository')) {
    function paginatorByRepository(BaseRepository $repository, int $limit, int $page, array $options = []): LengthAwarePaginator|null
    {
        $result = $repository->paginate($page, $limit);

        if (is_null($result->items)) return null;

        return paginator($result->items, $result->total, $limit, $page, $options);
    }
}
