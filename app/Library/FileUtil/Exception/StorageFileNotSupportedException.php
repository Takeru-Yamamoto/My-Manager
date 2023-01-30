<?php

namespace App\Library\FileUtil\Exceptions;

class StorageFileNotSupportedException extends \Exception
{
    public function __construct(string $filePath, string $mineType)
    {
        parent::__construct("このファイルがサポートされているストレージファイルがありません。 filePath: " . $filePath . " mineType: " . $mineType);
    }
}
