<?php

namespace App\Library\FileUtil\Exceptions;

class RequestFileNotFoundException extends \Exception
{
    public function __construct(string $fileName)
    {
        parent::__construct("アップロードされたファイルがありません。 fileName: " . $fileName);
    }
}
