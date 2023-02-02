<?php

namespace App\Library\FileUtil\Exception;

class RequestFileNotFoundException extends \Exception
{
    public function __construct(string $fileName)
    {
        parent::__construct("アップロードされたファイルがありません。 fileName: " . $fileName);
    }
}
