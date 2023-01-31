<?php

namespace App\Library\FileUtil\StorageFile;

use App\Library\FileUtil\StorageFile;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

final class ExcelStorageFile extends StorageFile
{
    public Spreadsheet $file;

    private int $count;

    private array $sheets;
    private array $data;

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

        $this->sheets    = [];
        $this->data      = [];

        for ($i = 0; $i < $this->count; $i++) {
            $sheet = $this->file->getSheet($i);

            $this->sheets[] = $sheet;
            $this->data[] = [
                "sheet" => $sheet,
                "name" => $sheet->getTitle(),
                "rows" => $sheet->getHighestRow(),
                "columns" => $sheet->getHighestRow(),
                "range" => $sheet->calculateWorksheetDimension(),
                "cells" => $sheet->rangeToArray($sheet->calculateWorksheetDimension(), null, true, true, false),
            ];
        }
    }

    protected function childParams(): array
    {
        return [
            "count" => $this->count(),
            "sheets" => $this->sheets(),
            "data" => $this->data(),
        ];
    }

    public function count(): int
    {
        return $this->count;
    }

    public function sheets(): array
    {
        return $this->sheets;
    }

    public function data(): array
    {
        return $this->data;
    }
}
