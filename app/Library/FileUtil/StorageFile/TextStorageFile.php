<?php

namespace App\Library\FileUtil\StorageFile;

use App\Library\FileUtil\StorageFile;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv as CSVReader;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

final class TextStorageFile extends StorageFile
{
    public Spreadsheet $file;

    private Worksheet $targetSheet;

    private string $characterCode;
    private array $data;

    function __construct(string $dirName, string $baseName)
    {
        parent::__construct($dirName, $baseName);
     
        $this->setChild();
    }

    public function save(string $dirName, string $baseName): self
    {
        if (!str_contains($baseName, ".csv")) $baseName .= ".csv";
        $writer = new Csv($this->file);
        $writer->save($dirName . "/" . $baseName);
        $this->reset($dirName, $baseName);
        return $this;
    }
    public function saveAsXLSX(string $dirName, string $baseName): self
    {
        if (!str_contains($baseName, ".xlsx")) $baseName .= ".xlsx";
        $writer = new Xlsx($this->file);
        $writer->save($dirName . "/" . $baseName);
        $this->reset($dirName, $baseName);
        return $this;
    }
    protected function setChild(): void
    {
        $csv = new CSVReader;

        $this->characterCode = $this->checkCharacterCode();
        $this->file          = $csv->setInputEncoding($this->characterCode)->load(str_replace("public", "storage", $this->filePath));
        $this->targetSheet   = $this->file->getSheet(0);
        $this->data          = $this->targetSheet->rangeToArray($this->targetSheet->calculateWorksheetDimension());
    }

    public function params(): array
    {
        $params = [
            "characterCode" => $this->characterCode(),
            "targetSheet"   => $this->targetSheet(),
            "data"          => $this->data(),
        ];

        return array_merge($params, parent::params());
    }

    public function characterCode(): string
    {
        return $this->characterCode;
    }
    public function targetSheet(): Worksheet
    {
        return $this->targetSheet;
    }
    public function data(): array
    {
        return $this->data;
    }

    public function cellValue(string $cell): mixed
    {
        return $this->targetSheet->getCell($cell)->getValue();
    }
    public function setCellValue(string $cell, mixed $value): self
    {
        $this->targetSheet->setCellValue($cell, $value);
        return $this;
    }
    public function cellValues(string $range = null): array
    {
        if (is_null($range)) $range = $this->targetSheet->calculateWorksheetDimension();
        return $this->targetSheet->rangeToArray($range, null, true, true, false);
    }
    public function setCellValues(array $values, string $startCell = null): self
    {
        $this->targetSheet->fromArray($values, null, $startCell, false);
        return $this;
    }
    public function cellIsNull(string $cell): bool
    {
        return is_null($this->cellValue($cell));
    }
    public function mergeCells(string $range): self
    {
        $this->targetSheet->mergeCells($range);
        return $this;
    }

    public function rowHeight(int $row): float
    {
        return $this->targetSheet->getRowDimension($row)->getRowHeight();
    }
    public function setRowHeight(int $row, float $height): self
    {
        $this->targetSheet->getRowDimension($row)->setRowHeight($height);
        return $this;
    }
    public function columnWidth(int $column): float
    {
        return $this->targetSheet->getColumnDimension($column)->getWidth();
    }
    public function setColumnWidth(int $column, float $width): self
    {
        $this->targetSheet->getColumnDimension($column)->setWidth($width);
        return $this;
    }

    private function checkCharacterCode(): string
    {
        $contents = file_get_contents($this->filePath);

        foreach (config("library.file.character_code") as $charset) {
            if ($contents === mb_convert_encoding($contents, $charset, $charset)) {
                return $charset;
            }
        }

        throw $this->CharacterCodeNotFoundException();
    }
}
