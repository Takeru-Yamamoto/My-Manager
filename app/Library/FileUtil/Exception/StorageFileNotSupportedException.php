<?php

namespace App\Library\FileUtil\Exception;

class StorageFileNotSupportedException extends \Exception
{
    public function __construct(string $filePath, string $mimeType)
    {
        parent::__construct("このファイルがサポートされているストレージファイルがありません。 ファイルパス: " . $filePath . " MIMEタイプ: " . $mimeType);
    }
}
