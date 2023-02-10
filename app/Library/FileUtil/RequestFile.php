<?php

namespace App\Library\FileUtil;

use Illuminate\Http\UploadedFile;

use App\Library\FileUtil\FileManager;
use App\Library\FileUtil\StorageFile;

abstract class RequestFile extends FileManager
{
    public readonly UploadedFile $file;

    function __construct(UploadedFile $file, string $dirName)
    {
        $this->file = $file;

        $this->setFileManager(
            $dirName,
            $this->file->getClientOriginalName(),
            $this->file->getClientMimeType(),
            $this->file->getSize(),
            $this->file->extension(),
        );
    }

    final public function upload(string $registerName = null): StorageFile
    {
        if (is_null($registerName)) $registerName = $this->baseName;
        $this->fileUpload($this->file, baseName: $registerName);

        $storageFile = match (true) {
            $this->isImageFile() => new StorageFile\ImageStorageFile($this->dirName, $this->baseName),
            $this->isVideoFile() => new StorageFile\VideoStorageFile($this->dirName, $this->baseName),
            $this->isTextFile()  => new StorageFile\TextStorageFile($this->dirName, $this->baseName),
            $this->isExcelFile() => new StorageFile\ExcelStorageFile($this->dirName, $this->baseName),

            default              => null,
        };

        if (is_null($storageFile)) {
            $this->delete();
            throw $this->StorageFileNotSupportedException();
        }

        return $storageFile;
    }

    final protected function setFileManager(string $dirName, string $baseName, string $mimeType = null, int $size = null, string $extension = null): void
    {
        $baseName = $this->avoidDuplicationName($dirName, $baseName);

        parent::setFileManager($dirName, $baseName, $mimeType, $size, $extension);
    }

    final private function avoidDuplicationName(string $dirName, string $baseName): string
    {
        $exploded = explode(".", $baseName);

        if ($exploded[1] !== $this->extension) {
            $baseName = $exploded[0] . "." . $this->extension;
        }

        for ($i = 1; $this->isExist($dirName . "/" . $baseName); $i++) {
            $baseName = match (str_contains($baseName, "(" . $i . ")")) {
                true  => str_replace("(" . $i . ")", "(" . ($i + 1) . ")", $baseName),
                false => $exploded[0] . "(" . $i . ")." . $this->extension,
            };
        }

        return $baseName;
    }
}
