<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('download')) {

    function download(string $path)
    {
        return Storage::download($path);
    }
}

