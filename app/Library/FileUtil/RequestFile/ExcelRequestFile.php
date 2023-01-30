<?php

namespace App\Library\FileUtil\RequestFile;

use App\Library\FileUtil\RequestFile;

use Illuminate\Http\UploadedFile;

final class ExcelRequestFile extends RequestFile
{
    function __construct(UploadedFile $file, ?string $additionalUploadDirectory, ?string $registerName)
    {
        parent::__construct($file, $additionalUploadDirectory, $registerName);
    }
}
