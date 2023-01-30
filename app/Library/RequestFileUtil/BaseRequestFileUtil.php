<?php

namespace App\Library\RequestFileUtil;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Intervention\Image\Facades\Image;

abstract class BaseRequestFileUtil
{
    public UploadedFile $file;

    /* file information */
    private string $name;
    private string $extension;
    private string $mineType;
    private int $size;
    private string $uploadDirectory;
    private string $downloadPath;
    private string $fullPath;
    private string $deletePath;
    private string $characterCode;

    private array $sheetData;
    private array $sheetTotalRows;
    private array $sheetNames;

    /* flag */
    private bool $isExistFile;
    private bool $isCheckCharacterCode;
    private bool $isSetData;
    private bool $isExistRequestFile;

    /* error */
    private string $error;

    /* contsruct */
    const BASE_UPLOAD_DIRECTORY = "public";
    const CHARACTER_CODE_LIST = array('UTF-8', 'eucJP-win', 'SJIS-win', 'ASCII', 'EUC-JP', 'SJIS', 'JIS');

    function __construct(Request $request, string $fileName, ?string $additionalUploadDirectory, ?string $registerName)
    {
        if (is_null($request->file($fileName))) {
            $this->isExistRequestFile = false;
            return $this;
        }
        $this->file                 = $request->file($fileName);
        $this->isExistRequestFile   = true;

        $this->name                 = $this->file->getClientOriginalName();
        $this->extension            = $this->file->extension();
        $this->mineType             = $this->file->getClientMimeType();
        $this->size                 = $this->file->getSize();

        $this->uploadDirectory      = self::BASE_UPLOAD_DIRECTORY;

        if (!is_string($additionalUploadDirectory)) {
            $this->uploadDirectory .= "/" . $additionalUploadDirectory;
        }

        $this->setName($registerName);

        $this->downloadPath         = $this->uploadDirectory . "/" . $this->name;
        $this->fullPath             = storage_path("app/" . $this->downloadPath);
        $this->deletePath           = $this->uploadDirectory . "/" . $this->name;

        $this->isExistFile          = false;
        $this->isCheckCharacterCode = false;
        $this->isSetData            = false;
    }

    final public function upload(): self
    {
        if ($this->isExistFile) return $this;

        $this->file->storeAs($this->uploadDirectory, $this->name);
        $this->isExistFile = true;

        return $this;
    }

    final public function delete(): self
    {
        if (!$this->isExistFile) return $this;

        Storage::delete($this->deletePath);
        $this->isExistFile = false;

        return $this;
    }

    public function params(): array
    {
        return [
            "name"      => $this->name(),
            "extension" => $this->extension(),
            "mineType"  => $this->mineType(),
            "size"      => $this->size(),
        ];
    }

    final public function name(): string
    {
        return $this->name;
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

    final public function downloadPath(): string
    {
        return $this->downloadPath;
    }

    final public function fullPath(): string
    {
        return $this->fullPath;
    }

    final public function characterCode(): string
    {
        if (!$this->isCheckCharacterCode) {
            $this->characterCode = $this->checkCharacterCode();
        }

        return $this->characterCode;
    }

    final public function convertToMP4(): bool
    {
        if (!$this->isUploaded()) return false;

        try {
            $oldName = $this->name;
            $newName = str_replace("." . $this->extension, ".mp4", $this->name);

            $format = new \FFMpeg\Format\Video\X264("libmp3lame", "libx264");
            FFMpeg::fromdisk("local")->open($this->uploadDirectory . "/" . $oldName)->export()->toDisk('local')->inFormat($format)->save($this->uploadDirectory . "/" . $newName);

            $this->delete();

            $this->isExistFile  = true;
            $this->extension    = "mp4";
            $this->name         = $newName;
            $this->downloadPath = str_replace($oldName, $newName, $this->downloadPath);
            $this->fullPath     = str_replace($oldName, $newName, $this->fullPath);
            $this->deletePath   = str_replace($oldName, $newName, $this->deletePath);
        } catch (\Exception $ex) {
            return false;
        }
    }

    public function convertToJPG(): bool
    {
        if (!$this->isUploaded()) return false;

        try {
            $oldName = $this->name;
            $newName = str_replace("." . $this->extension, ".jpg", $this->name);

            Image::make($this->file)->encode("jpg")->save($this->uploadDirectory . "/" . $newName);

            $this->delete();

            $this->isExistFile = true;
            $this->extension   = "jpg";
            $this->name        = $newName;
            $this->fullPath    = str_replace($oldName, $newName, $this->fullPath);
            $this->deletePath  = str_replace($oldName, $newName, $this->deletePath);
        } catch (\Exception $ex) {
            return false;
        }
    }

    final public function setData(): self
    {
        if (!$this->isExistFile) return $this;

        try {
            if ($this->isCheckCharacterCode) {
                $this->convertToArrayFromTextFile();
            } else {
                $this->convertToSheetDataFromExcelFile();
            }

            $this->isSetData = true;
        } catch (\Exception $ex) {
            $this->error = $ex->getMessage();
        } finally {
            return $this;
        }
    }

    final public function error(): string
    {
        return $this->error;
    }

    final public function sheetData(?string $key): mixed
    {
        if (!$this->isSetData) return false;

        if (array_key_exists($key, $this->sheetData)) return $this->sheetData[$key];

        return $this->sheetData;
    }

    final public function sheetTotalRow(?string $key): mixed
    {
        if (!$this->isSetData) return false;

        if (array_key_exists($key, $this->sheetTotalRows)) return $this->sheetTotalRows[$key];

        return $this->sheetTotalRows;
    }

    final public function sheetName(): array
    {
        if (!$this->isSetData) return [];

        return $this->sheetNames;
    }

    final public function isInvalid(): bool
    {
        return !$this->isExistRequestFile;
    }

    final public function isUploaded(): bool
    {
        return $this->isExistFile;
    }

    public function isImage(): bool
    {
        return !$this->isInvalid() && strpos($this->mineType(), 'image') !== false;
    }

    public function isVideo(): bool
    {
        return !$this->isInvalid() && strpos($this->mineType(), 'video') !== false;
    }

    private function setName(?string $registerName)
    {
        if (!is_null($registerName)) {
            $this->name = $registerName;
            return;
        }

        $this->name = $this->file->getClientOriginalName();

        if (strpos($this->name, "") !== false) {
            $this->name = str_replace(" ", "", $this->name);
        }

        $exploded = explode(".", $this->name);

        if ($exploded[1] !== $this->extension) {
            $this->name = $exploded[0] . "." . $this->extension;
        }

        for ($i = 1; File::exists(storage_path("app/" . $this->uploadDirectory . "/" . $this->name)); $i++) {
            if (strpos($this->name, "(" . $i . ")") !== false) {
                $this->name = str_replace("(" . $i . ")", "(" . ($i + 1) . ")", $this->name);
            } else {
                $this->name = $exploded[0] . "(" . $i . ")." . $this->extension;
            }
        }
    }

    final private function checkCharacterCode(): string
    {
        if (!$this->isExistFile) return "";

        $contents = file_get_contents($this->fullPath);

        foreach (self::CHARACTER_CODE_LIST as $charset) {
            if ($contents == mb_convert_encoding($contents, $charset, $charset)) {
                $this->isCheckCharacterCode = true;
                return $charset;
            }
        }

        return "";
    }

    final private function convertToArrayFromTextFile(): bool
    {
        $csv = new Csv;

        $csv->setInputEncoding($this->characterCode);

        $obj       = $csv->load($this->fullPath);
        $sheet_obj = $obj->getSheet(0);
        $range     = $sheet_obj->calculateWorksheetDimension();

        $this->sheetData = $sheet_obj->rangeToArray($range);

        return true;
    }

    final private function convertToSheetDataFromExcelFile(): bool
    {
        $obj = IOFactory::load($this->fullPath);

        $count = $obj->getSheetCount();

        $this->sheetData      = array();
        $this->sheetTotalRows = array();
        $this->sheetNames     = array();

        for ($i = 0; $i < $count; $i++) {
            $sheet_obj = $obj->getSheet($i);
            $range     = $sheet_obj->calculateWorksheetDimension();

            if ($range === "A1:A1") continue;

            $this->sheetData[$sheet_obj->getTitle()]      = $sheet_obj->rangeToArray($range);
            $this->sheetTotalRows[$sheet_obj->getTitle()] = $sheet_obj->getHighestRow();
            $this->sheetNames[]                           = $sheet_obj->getTitle();
        }

        return true;
    }
}
