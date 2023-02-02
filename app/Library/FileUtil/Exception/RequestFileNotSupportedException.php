<?php

namespace App\Library\FileUtil\Exception;

class RequestFileNotSupportedException extends \Exception
{
    public function __construct(string $fileName, string $mimeType)
    {
        parent::__construct("このファイルがサポートされているリクエストファイルがありません。 fileName: " . $fileName . " mimeType: " . $mimeType);
    }
}
