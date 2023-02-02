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
        $path = explode("/", request()->path());
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
        return is_null($result->items) ? null : paginator($result->items, $result->total, $limit, $page, $options);
    }
}
