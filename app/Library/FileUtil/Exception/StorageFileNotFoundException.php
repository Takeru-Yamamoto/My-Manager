<?php

namespace App\Library\FileUtil\Exceptions;

class StorageFileNotFoundException extends \Exception
{
    public function __construct(string $filePath)
    {
        parent::__construct("入力されたPathのファイルがありません。 filePath: " . $filePath);
    }
}
