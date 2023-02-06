<?php

namespace App\Library\FileUtil\StorageFile;

use App\Library\FileUtil\StorageFile;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

final class ExcelStorageFile extends StorageFile
{
    public Spreadsheet $file;

    private int $sheetCount;

    private array $sheets;
    private array $sheetData;

    private Worksheet $targetSheet;
    private int $targetSheetPage;

    function __construct(string $uploadDirectory, string $fileName)
    {
        parent::__construct($uploadDirectory, $fileName);

        $this->setChild();
    }

    public function save(string $uploadDirectory, string $fileName): self
    {
        if (strpos($fileName, ".xlsx") === false) $fileName .= ".xlsx";
        $writer = new Xlsx($this->file);
        $writer->save($uploadDirectory . "/" . $fileName);
        $this->reset($uploadDirectory, $fileName);
        return $this;
    }
    public function saveAsCSV(string $uploadDirectory, string $fileName): self
    {
        if (strpos($fileName, ".csv") === false) $fileName .= ".csv";
        $writer = new Csv($this->file);
        $writer->save($uploadDirectory . "/" . $fileName);
        $this->reset($uploadDirectory, $fileName);
        return $this;
    }

    protected function setChild(): void
    {
        $this->file = IOFactory::load(str_replace("public", "storage", $this->filePath));

        $this->sheetCount = $this->file->getSheetCount();

        $this->pivotFirst();

        $this->sheets    = [];
        $this->sheetData = [];

        for ($i = 0; $i < $this->sheetCount; $i++) {
            $sheet = $this->file->getSheet($i);

            $this->sheets[]    = $sheet;
            $this->sheetData[] = [
                "page"    => $i,
                "name"    => $sheet->getTitle(),
                "rows"    => $sheet->getHighestRow(),
                "columns" => $sheet->getHighestRow(),
                "range"   => $sheet->calculateWorksheetDimension(),
            ];
        }
    }

    protected function childParams(): array
    {
        return [
            "sheets"          => $this->sheets(),
            "sheetCount"      => $this->sheetCount(),
            "sheetData"       => $this->sheetData(),
            "targetSheet"     => $this->targetSheet(),
            "targetSheetPage" => $this->targetSheetPage(),
        ];
    }
    public function sheets(): array
    {
        return $this->sheets;
    }
    public function sheetCount(): int
    {
        return $this->sheetCount;
    }
    public function sheetData(): array
    {
        return $this->sheetData;
    }
    public function targetSheet(): Worksheet
    {
        return $this->targetSheet;
    }
    public function targetSheetPage(): int
    {
        return $this->targetSheetPage;
    }

    public function selectSheet(int $page = null): self
    {
        if (is_null($page)) $page = $this->targetSheetPage;
        if ($page >= 0 && $page <= $this->sheetCount) $this->targetSheet = $this->file->getSheet($page);
        return $this;
    }
    public function pivotPrev(): self
    {
        if ($this->targetSheetPage !== 0) $this->targetSheetPage--;
        return $this->selectSheet();
    }
    public function pivotNext(): self
    {
        if ($this->targetSheetPage < $this->sheetCount) $this->targetSheetPage++;
        return $this->selectSheet();
    }
    public function pivotFirst(): self
    {
        $this->targetSheetPage = 0;
        return $this->selectSheet();
    }
    public function pivotLast(): self
    {
        $this->targetSheetPage = $this->sheetCount;
        return $this->selectSheet();
    }
    public function addSheet(string $sheetName): self
    {
        $sheet = new Worksheet($this->file, $sheetName);
        $this->file->addSheet($sheet);
        return $this;
    }
    public function sheetTitle(): string
    {
        return $this->targetSheet->getTitle();
    }
    public function setSheetTitle(string $title): self
    {
        $this->targetSheet->setTitle($title);
        return $this;
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
}
