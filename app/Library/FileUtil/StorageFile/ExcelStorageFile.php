<?php

namespace App\Library\FileUtil\StorageFile;

use App\Library\FileUtil\StorageFile;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

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

    public function setSheet(int $page = null): self
    {
        if (is_null($page)) $page = $this->targetSheetPage;
        if ($page >= 0 && $page <= $this->sheetCount) $this->targetSheet = $this->file->getSheet($page);
        return $this;
    }
    public function pivotPrev(): self
    {
        if ($this->targetSheetPage !== 0) $this->targetSheetPage--;
        return $this->setSheet();
    }
    public function pivotNext(): self
    {
        if ($this->targetSheetPage < $this->sheetCount) $this->targetSheetPage++;
        return $this->setSheet();
    }
    public function pivotFirst(): self
    {
        $this->targetSheetPage = 0;
        return $this->setSheet();
    }
    public function pivotLast(): self
    {
        $this->targetSheetPage = $this->sheetCount;
        return $this->setSheet();
    }

    public function allCellValue(): array
    {
        return $this->targetSheet->rangeToArray($this->targetSheet->calculateWorksheetDimension(), null, true, true, false);
    }
    public function cellValue(string $cell): mixed
    {
        return $this->targetSheet->getCell($cell)->getValue();
    }
    public function cellIsNull(string $cell): bool
    {
        return is_null($this->cellValue($cell));
    }
}
