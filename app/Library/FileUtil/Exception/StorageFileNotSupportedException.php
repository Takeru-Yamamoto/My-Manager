<?php

namespace App\Library\FileUtil\Exception;

class StorageFileNotSupportedException extends \Exception
{
    public function __construct(string $filePath, string $mimeType, string $extension)
    {
        parent::__construct("このファイルがサポートされているストレージファイルがありません。 filePath: " . $filePath . " mimeType: " . $mimeType . " extension: " . $extension);
    }
}
