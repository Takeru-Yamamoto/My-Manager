<?php

namespace App\Library\FileUtil\RequestFile;

use App\Library\FileUtil\RequestFile;

use Illuminate\Http\UploadedFile;

final class ExcelRequestFile extends RequestFile
{
    function __construct(UploadedFile $file, string $dirName)
    {
        parent::__construct($file, $dirName);
    }
}
