<?php

namespace App\Library\FileUtil\StorageFile;

use App\Library\FileUtil\Exceptions\CharacterCodeNotFoundException;
use App\Library\FileUtil\StorageFile;

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

final class TextStorageFile extends StorageFile
{
    public Worksheet $file;

    private string $characterCode;
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
        $csv = new Csv;

        $this->characterCode = $this->checkCharacterCode();
        $this->file          = $csv->setInputEncoding($this->characterCode)->load($this->filePath)->getSheet(0);
        $this->data          = $this->file->rangeToArray($this->file->calculateWorksheetDimension());
    }
    protected function childParams(): array
    {
        return [
            "characterCode" => $this->characterCode(),
            "data"          => $this->data(),
        ];
    }

    public function characterCode(): string
    {
        return $this->characterCode;
    }
    public function data(): array
    {
        return $this->data;
    }

    private function checkCharacterCode(): string
    {
        $contents = file_get_contents($this->filePath);

        foreach (config("library.file.character_code") as $charset) {
            if ($contents === mb_convert_encoding($contents, $charset, $charset)) {
                return $charset;
            }
        }

        throw new CharacterCodeNotFoundException($this->filePath);
    }
}
