<?php

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\BaseRepository;

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

if (!function_exists('paginatorByRepository')) {
    function paginatorByRepository(BaseRepository $repository, int $limit, string $path, int $page, array $options = []): LengthAwarePaginator|null
    {
        $result = $repository->paginate($page, $limit);

        if (is_null($result->items)) return null;

        return paginator($result->items, $result->total, $limit, $path, $page, $options);
    }
}
