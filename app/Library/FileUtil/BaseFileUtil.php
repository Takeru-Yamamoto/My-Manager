<?php

namespace App\Library\FileUtil;

use App\Library\FileUtil\RequestFile;
use App\Library\FileUtil\StorageFile;
use App\Library\FileUtil\FileManager;

use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

abstract class BaseFileUtil extends FileManager
{
    protected array $files;

    function __construct() {
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

    public function requestFile(Request $request, string $postName, string $dirName = ""): self
    {
        if (is_null($request->file($postName))) throw $this->RequestFileNotFoundException($postName);

        $files = is_array($request->file($postName)) ? $request->file($postName) : [$request->file($postName)];

        foreach ($files as $file) {
            $requestFile = match (true) {
                $this->isImageFile($file->getClientMimeType()) => new RequestFile\ImageRequestFile($file, $dirName),
                $this->isVideoFile($file->getClientMimeType()) => new RequestFile\VideoRequestFile($file, $dirName),
                $this->isTextFile($file->getClientMimeType())  => new RequestFile\TextRequestFile($file, $dirName),
                $this->isExcelFile($file->getClientMimeType()) => new RequestFile\ExcelRequestFile($file, $dirName),

                default                                        => null
            };

            if (!$requestFile instanceof RequestFile) throw $this->RequestFileNotSupportedException($file->getClientOriginalName(), $file->getClientMimeType());

            $this->files["request"][] = $requestFile;
        }

        return $this;
    }

    public function storageFile(string $baseName, string $dirName = null): self
    {
        $mimeType = $this->mimeType($dirName . "/" . $baseName);

        $storageFile = match (true) {
            $this->isImageFile($mimeType) => new StorageFile\ImageStorageFile($dirName, $baseName),
            $this->isVideoFile($mimeType) => new StorageFile\VideoStorageFile($dirName, $baseName),
            $this->isTextFile($mimeType)  => new StorageFile\TextStorageFile($dirName, $baseName),
            $this->isExcelFile($mimeType) => new StorageFile\ExcelStorageFile($dirName, $baseName),

            default                       => null
        };

        if (!$storageFile instanceof StorageFile) throw $this->StorageFileNotSupportedException($dirName . "/" . $baseName, $mimeType);

        $this->files["storage"][] = $storageFile;

        return $this;
    }

    public function createEXCEL(string $baseName, string $dirName = null): self
    {
        if (str_contains($baseName, ".xlsx") === false) $baseName .= ".xlsx";
        $sheet = new Spreadsheet();
        $writer = new Xlsx($sheet);
        $writer->save($dirName . "/" . $baseName);
        $this->files["storage"][] = new StorageFile\ExcelStorageFile($dirName, $baseName);
        return $this;
    }

    public function createCSV(string $baseName, string $dirName = null): self
    {
        if (str_contains($baseName, ".csv") === false) $baseName .= ".csv";
        $sheet = new Spreadsheet();
        $writer = new Csv($sheet);
        $writer->save($dirName . "/" . $baseName);
        $this->files["storage"][] = new StorageFile\TextStorageFile($dirName, $baseName);
        return $this;
    }
}
