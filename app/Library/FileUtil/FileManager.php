<?php

namespace App\Library\FileUtil;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Library\FileUtil\Exception;

abstract class FileManager
{
    protected string $dirName;
    protected string $baseName;

    protected string $filePath;

    protected string $mimeType;
    protected int $size;

    protected string $extension;
    protected string $fileName;

    protected function setFileManager(
        string $dirName,
        string $baseName,
        string $mimeType = null,
        int $size = null,
        string $extension = null,
    ): void {
        if (!str_contains($dirName, "publlic")) $dirName = empty($dirName) || $dirName === "/" ? "public" : "public/" . $dirName;

        $this->dirName  = $dirName;
        $this->baseName = $baseName;

        $this->filePath = $this->dirName . "/" . $this->baseName;

        $this->mimeType = is_null($mimeType) ? $this->mimeType() : $mimeType;
        $this->size     = is_null($size) ? $this->size() : $size;

        if (is_null($extension)) {
            $exploded        = explode(".", $baseName);
            $this->extension = end($exploded);
        } else {
            $this->extension = $extension;
        }

        $this->fileName = str_replace("." . $this->extension, "", $baseName);
    }

    public function params(): array
    {
        return [
            "dirName"   => $this->dirName,
            "baseName"  => $this->baseName,
            "fileName"  => $this->fileName,
            "extension" => $this->extension,
            "mimeType"  => $this->mimeType,
            "size"      => $this->size,
            "filePath"  => $this->filePath,
        ];
    }


    /* file type */
    final public function isImageFile(string $mimeType = null): bool
    {
        if (is_null($mimeType)) $mimeType = $this->mimeType;
        return str_contains($mimeType, 'image');
    }
    final public function isVideoFile(string $mimeType = null): bool
    {
        if (is_null($mimeType)) $mimeType = $this->mimeType;
        return str_contains($mimeType, 'video');
    }
    final public function isTextFile(string $mimeType = null): bool
    {
        if (is_null($mimeType)) $mimeType = $this->mimeType;
        return str_contains($mimeType, 'text');
    }
    final public function isExcelFile(string $mimeType = null): bool
    {
        if (is_null($mimeType)) $mimeType = $this->mimeType;
        return str_contains($mimeType, 'vnd.ms-excel') || str_contains($mimeType, 'vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }

    /* wrap */
    final public function fileUpload(UploadedFile $file, string $dirName = null, string $baseName = null): string|false
    {
        if (is_null($dirName)) $dirName = $this->dirName;
        if (is_null($baseName)) $baseName = $this->baseName;
        return $file->storeAs($dirName, $baseName);
    }
    final public function download(string $filePath = null): StreamedResponse
    {
        if (is_null($filePath)) $filePath = $this->filePath;
        return Storage::download($filePath);
    }
    final public function delete(string $filePath = null): bool
    {
        if (is_null($filePath)) $filePath = $this->filePath;
        return Storage::delete($filePath);
    }
    final public function isExist(string $filePath = null): bool
    {
        if (is_null($filePath)) $filePath = $this->filePath;
        return Storage::exists($filePath);
    }
    final public function mimeType(string $filePath = null): string
    {
        if (is_null($filePath)) $filePath = $this->filePath;
        return Storage::mimeType($filePath);
    }
    final public function size(string $filePath = null): string
    {
        if (is_null($filePath)) $filePath = $this->filePath;
        return Storage::size($filePath);
    }

    /* exception */
    final public function RequestFileNotFoundException(string $postName): Exception\RequestFileNotFoundException
    {
        return new Exception\RequestFileNotFoundException($postName);
    }
    final public function RequestFileNotSupportedException(string $baseName, string $mimeType = null): Exception\RequestFileNotSupportedException
    {
        if (is_null($mimeType)) $mimeType = $this->mimeType;
        return new Exception\RequestFileNotSupportedException($baseName, $mimeType);
    }
    final public function StorageFileNotFoundException(string $filePath = null): Exception\StorageFileNotFoundException
    {
        if (is_null($filePath)) $filePath = $this->filePath;
        return new Exception\StorageFileNotFoundException($filePath);
    }
    final public function StorageFileNotSupportedException(string $filePath = null, string $mimeType = null): Exception\StorageFileNotSupportedException
    {
        if (is_null($filePath)) $filePath = $this->filePath;
        if (is_null($mimeType)) $mimeType = $this->mimeType;
        return new Exception\StorageFileNotSupportedException($filePath, $mimeType);
    }
    final public function CharacterCodeNotFoundException(string $filePath = null): Exception\CharacterCodeNotFoundException
    {
        if (is_null($filePath)) $filePath = $this->filePath;
        return new Exception\CharacterCodeNotFoundException($filePath);
    }
}
