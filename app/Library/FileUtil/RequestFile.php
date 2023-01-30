<?php

namespace App\Library\FileUtil;

use App\Library\FileUtil\Exceptions\StorageFileNotSupportedException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Library\FileUtil\StorageFile;

abstract class RequestFile
{
    public UploadedFile $file;
    public ?StorageFile $storageFile;

    protected string $fileName;
    protected string $extension;
    protected string $mineType;
    protected int $size;

    protected string $uploadDirectory;
    protected string $filePath;

    const BASE_UPLOAD_DIRECTORY = "public";

    function __construct(UploadedFile $file, ?string $additionalUploadDirectory, ?string $registerName)
    {
        $this->file = $file;

        $this->fileName  = is_null($registerName) ? $this->file->getClientOriginalName() : $registerName;
        $this->extension = $this->file->extension();
        $this->mineType  = $this->file->getClientMimeType();
        $this->size      = $this->file->getSize();

        $this->uploadDirectory = self::BASE_UPLOAD_DIRECTORY;
        if (!is_string($additionalUploadDirectory)) {
            $this->uploadDirectory .= "/" . $additionalUploadDirectory;
        }

        $this->isNameDuplicate();

        $this->filePath = storage_path("app/" . $this->uploadDirectory . "/" . $this->fileName);

        $this->storageFile = null;
    }

    final public function upload(): self
    {
        if ($this->isUploaded()) return $this;

        $this->file->storeAs($this->uploadDirectory, $this->fileName);

        if ($this->isImageFile()) {
            $this->storageFile = new StorageFile\ImageStorageFile($this->uploadDirectory, $this->fileName);
        } elseif ($this->isVideoFile()) {
            $this->storageFile = new StorageFile\VideoStorageFile($this->uploadDirectory, $this->fileName);
        } elseif ($this->isTextFile()) {
            $this->storageFile = new StorageFile\TextStorageFile($this->uploadDirectory, $this->fileName);
        } elseif ($this->isExcelFile()) {
            $this->storageFile = new StorageFile\ExcelStorageFile($this->uploadDirectory, $this->fileName);
        } else {
            $this->delete();
            throw new StorageFileNotSupportedException($this->filePath, $this->mineType);
        }

        return $this;
    }

    final public function delete(): self
    {
        if (!$this->isUploaded()) return $this;

        $this->storageFile->delete();
        $this->storageFile = null;

        return $this;
    }

    final public function storageFile(): StorageFile|null
    {
        return $this->storageFile;
    }

    final public function isUploaded(): bool
    {
        return !is_null($this->storageFile);
    }

    final public function isImageFile(): bool
    {
        return strpos($this->mineType(), 'image') !== false;
    }

    final public function isVideoFile(): bool
    {
        return strpos($this->mineType(), 'image') !== false;
    }

    final public function isTextFile(): bool
    {
        return strpos($this->mineType(), 'text') !== false;
    }

    final public function isExcelFile(): bool
    {
        return in_array($this->extension(), config("library.file.accept_excel", []));
    }

    final public function params(): array
    {
        $params = [
            "fileName"  => $this->fileName(),
            "extension" => $this->extension(),
            "mineType"  => $this->mineType(),
            "size"      => $this->size(),
            "filePath"  => $this->filePath(),
        ];

        return $this->isUploaded() ? arrayMergeUnique($params, $this->storageFile->params()) : $params;
    }

    final public function fileName(): string
    {
        return $this->fileName;
    }

    final public function extension(): string
    {
        return $this->extension;
    }

    final public function mineType(): string
    {
        return $this->mineType;
    }

    final public function size(): int
    {
        return $this->size;
    }

    final public function filePath(): string
    {
        return $this->filePath;
    }

    final private function isNameDuplicate()
    {
        $exploded = explode(".", $this->fileName);

        if ($exploded[1] !== $this->extension) {
            $this->fileName = $exploded[0] . "." . $this->extension;
        }

        for ($i = 1; Storage::exists($this->uploadDirectory . "/" . $this->fileName); $i++) {
            if (strpos($this->fileName, "(" . $i . ")") !== false) {
                $this->fileName = str_replace("(" . $i . ")", "(" . ($i + 1) . ")", $this->fileName);
            } else {
                $this->fileName = $exploded[0] . "(" . $i . ")." . $this->extension;
            }
        }
    }
}
