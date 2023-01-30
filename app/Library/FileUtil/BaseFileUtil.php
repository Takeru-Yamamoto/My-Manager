<?php

namespace App\Library\FileUtil;

use App\Library\FileUtil\Exceptions\RequestFileNotFoundException;
use App\Library\FileUtil\Exceptions\RequestFileNotSupportedException;
use App\Library\FileUtil\RequestFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

abstract class BaseFileUtil
{
    protected array $files;

    function __construct()
    {
        $this->files = [];
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function getRequestFiles(): array
    {
        return isset($this->files["request"]) ? $this->files["request"] : [];
    }

    public function getStorageFiles(): array
    {
        return isset($this->files["storage"]) ? $this->files["storage"] : [];
    }

    public function requestFile(Request $request, string $fileName, ?string $additionalUploadDirectory = null, ?string $registerName = null): self
    {
        if (is_null($request->file($fileName))) throw new RequestFileNotFoundException($fileName);

        $files = is_array($request->file($fileName)) ? $request->file($fileName) : [$request->file($fileName)];

        foreach ($files as $file) {
            if (strpos($file->getClientMimeType(), 'image') !== false) {
                $this->files["request"][] = new RequestFile\ImageRequestFile($file, $additionalUploadDirectory, $registerName);
            } elseif (strpos($file->getClientMimeType(), 'video') !== false) {
                $this->files["request"][] = new RequestFile\VideoRequestFile($file, $additionalUploadDirectory, $registerName);
            } elseif (strpos($file->getClientMimeType(), 'text') !== false) {
                $this->files["request"][] = new RequestFile\TextRequestFile($file, $additionalUploadDirectory, $registerName);
            } elseif (in_array($file->extension(), config("library.file.accept_excel", []))) {
                $this->files["request"][] = new RequestFile\ExcelRequestFile($file, $additionalUploadDirectory, $registerName);
            } else {
                throw new RequestFileNotSupportedException($file->getClientOriginalName(), $file->getClientMimeType());
            }
        }

        return $this;
    }

    public function addStorageFile(string $uploadDirectory, string $fileName): self
    {

        return $this;
    }
}
