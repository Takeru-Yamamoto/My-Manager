<?php

namespace App\Library\FileUtil\StorageFile;

use App\Library\FileUtil\StorageFile;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

final class ExcelStorageFile extends StorageFile
{
    public Spreadsheet $file;

    private int $count;

    private array $names;
    private array $data;
    private array $totalRows;

    function __construct(string $uploadDirectory, string $fileName)
    {
        parent::__construct($uploadDirectory, $fileName);

        $this->setChild();
    }

    public function save(string $uploadDirectory, string $fileName): self
    {
        $this->reset($uploadDirectory, $fileName);
        return $this;
    }

    protected function setChild(): void
    {
        $this->file = IOFactory::load($this->filePath);

        $this->count = $this->file->getSheetCount();

        $this->names     = [];
        $this->data      = [];
        $this->totalRows = [];

        for ($i = 0; $i < $this->count; $i++) {
            $sheet = $this->file->getSheet($i);
            $range     = $sheet->calculateWorksheetDimension();

            if ($range === "A1:A1") continue;

            $this->names[]                       = $sheet->getTitle();
            $this->data[$sheet->getTitle()]      = $sheet->rangeToArray($range);
            $this->totalRows[$sheet->getTitle()] = $sheet->getHighestRow();
        }
    }

    protected function childParams(): array
    {
        return [
            "count"     => $this->count(),
            "names"     => $this->names(),
            "data"      => $this->data(),
            "totalRows" => $this->totalRows(),
        ];
    }

    public function count(): int
    {
        return $this->count;
    }

    public function names(): array
    {
        return $this->names;
    }

    public function data(): array
    {
        return $this->data;
    }

    public function totalRows(): array
    {
        return $this->totalRows;
    }
}
