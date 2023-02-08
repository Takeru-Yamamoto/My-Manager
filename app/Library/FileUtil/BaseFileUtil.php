<?php

namespace App\Library\FileUtil;

use App\Library\FileUtil\Exception\RequestFileNotFoundException;
use App\Library\FileUtil\Exception\RequestFileNotSupportedException;
use App\Library\FileUtil\Exception\StorageFileNotSupportedException;
use App\Library\FileUtil\RequestFile;
use App\Library\FileUtil\StorageFile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function findRequestFile(int $key = 0): RequestFile|null
    {
        return isset($this->files["request"][$key]) ? $this->files["request"][$key] : null;
    }

    public function getRequestFiles(): array
    {
        return isset($this->files["request"]) ? $this->files["request"] : [];
    }

    public function findStorageFile(int $key = 0): StorageFile|null
    {
        return isset($this->files["storage"][$key]) ? $this->files["storage"][$key] : null;
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
            if (str_contains($file->getClientMimeType(), 'image')) {
                $this->files["request"][] = new RequestFile\ImageRequestFile($file, $additionalUploadDirectory, $registerName);
            } elseif (str_contains($file->getClientMimeType(), 'video')) {
                $this->files["request"][] = new RequestFile\VideoRequestFile($file, $additionalUploadDirectory, $registerName);
            } elseif (str_contains($file->getClientMimeType(), 'text')) {
                $this->files["request"][] = new RequestFile\TextRequestFile($file, $additionalUploadDirectory, $registerName);
            } elseif (in_array($file->extension(), config("library.file.accept_excel", []))) {
                $this->files["request"][] = new RequestFile\ExcelRequestFile($file, $additionalUploadDirectory, $registerName);
            } else {
                throw new RequestFileNotSupportedException($file->getClientOriginalName(), $file->getClientMimeType());
            }
        }

        return $this;
    }

    public function storageFile(string $uploadDirectory, string $fileName): self
    {
        $mimeType = Storage::mimeType($uploadDirectory . "/" . $fileName);
        $extension = Storage::extension($uploadDirectory . "/" . $fileName);

        if (str_contains($mimeType, 'image')) {
            $this->files["storage"][] = new StorageFile\ImageStorageFile($uploadDirectory, $fileName);
        } elseif (str_contains($mimeType, 'video')) {
            $this->files["storage"][] = new StorageFile\VideoStorageFile($uploadDirectory, $fileName);
        } elseif (str_contains($mimeType, 'text')) {
            $this->files["storage"][] = new StorageFile\TextStorageFile($uploadDirectory, $fileName);
        } elseif (in_array($extension, config("library.file.accept_excel", []))) {
            $this->files["storage"][] = new StorageFile\ExcelStorageFile($uploadDirectory, $fileName);
        } else {
            throw new StorageFileNotSupportedException($uploadDirectory . "/" . $fileName, $mimeType, $extension);
        }

        return $this;
    }

    public function createEXCEL(string $uploadDirectory, string $fileName): self
    {
        if (str_contains($fileName, ".xlsx") === false) $fileName .= ".xlsx";
        $sheet = new Spreadsheet();
        $writer = new Xlsx($sheet);
        $writer->save($uploadDirectory . "/" . $fileName);
        $this->files["storage"][] = new StorageFile\ExcelStorageFile($uploadDirectory, $fileName);
        return $this;
    }

    public function createCSV(string $uploadDirectory, string $fileName): self
    {
        if (str_contains($fileName, ".csv") === false) $fileName .= ".csv";
        $sheet = new Spreadsheet();
        $writer = new Csv($sheet);
        $writer->save($uploadDirectory . "/" . $fileName);
        $this->files["storage"][] = new StorageFile\TextStorageFile($uploadDirectory, $fileName);
        return $this;
    }
}
