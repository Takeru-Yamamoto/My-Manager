<?php

namespace App\Library\FileUtil\Exception;

class StorageFileNotFoundException extends \Exception
{
    public function __construct(string $filePath)
    {
        parent::__construct("入力されたPathのファイルがありません。 ファイルパス: " . $filePath);
    }
}
