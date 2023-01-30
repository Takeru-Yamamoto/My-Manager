<?php

namespace App\Library\FileUtil\Exceptions;

class RequestFileNotSupportedException extends \Exception
{
    public function __construct(string $fileName, string $mineType)
    {
        parent::__construct("このファイルがサポートされているリクエストファイルがありません。 fileName: " . $fileName . " mineType: " . $mineType);
    }
}
