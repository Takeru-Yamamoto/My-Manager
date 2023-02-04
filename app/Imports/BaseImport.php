<?php

namespace App\Imports;

use App\Errors\ImportError;
use App\Exceptions\ImportException;

abstract class BaseImport
{
    /* 
        data: insert / upsert するデータ
        columns: insert / upsert するデータベースのカラム名とカラム名の日本語表記。key => データベースのカラム名 value => カラム名の日本語表記
    */

    private array $originData;
    private array $importedData;
    private array $columns;
    private array $errors;
    private int $threshold;
    private int $count;
    private bool $writeErrorLogFlg;
    private bool $throwExceptionFlg;

    public function __construct(array $data, array $columns, int $threshold = 1000)
    {
        $this->originData        = $data;
        $this->columns           = $columns;
        $this->threshold         = $threshold;

        $this->importedData      = [];
        $this->errors            = [];
        $this->count             = 0;
        $this->writeErrorLogFlg  = true;
        $this->throwExceptionFlg = true;
    }

    abstract protected function insert(array $data): void;
    abstract protected function upsert(array $data): void;
    abstract protected function isExist(array $row): bool;

    protected function createImportData(array $row): array
    {
        $data = [];
        $i = 0;

        foreach (array_keys($this->columns) as $columnName) {
            $data[$columnName] = $row[$i];
        }

        return $data;
    }

    protected function isFirstRow(array $row): bool
    {
        if (count($this->columns) !== count($row)) return false;

        $i = 0;
        foreach ($this->columns as $columnNameJapanese) {
            if ($row[$i] !== $columnNameJapanese) return false;
        }

        return true;
    }

    protected function isValid(array $row): bool
    {
        if (count($this->columns) !== count($row)) return false;

        foreach ($row as $value) {
            if (is_null($value)) return false;
        }

        return true;
    }

    final public function insertStart(): void
    {
        emphasisLogStart("IMPORT " . className($this));

        foreach ($this->originData as $row) {
            try {
                if (is_array($row[0])) {
                    $this->insertStart();
                    continue;
                }

                if ($this->isFirstRow($row)) continue;

                if (!$this->isValid($row)) {
                    $this->catchError($row, configText("import_validation_invalid"));
                    continue;
                }

                if ($this->isExist($row)) {
                    $this->catchError($row, configText("import_data_exist"));
                    continue;
                }

                $this->importedData[] = $this->createImportData($row);

                if (count($this->importedData) >= $this->threshold) {
                    $this->insert($this->importedData);
                    $this->importedData = [];
                }

                $this->count++;
            } catch (\Exception $e) {
                $this->catchError($row, $e->getMessage());
            }
        }

        if (count($this->importedData) > 0) $this->insert($this->importedData);

        emphasisLogEnd("IMPORT " . className($this));

        if (!empty($this->errors)) $this->throwException();
    }

    final public function upsertStart(): void
    {
        emphasisLogStart("IMPORT " . className($this));

        foreach ($this->originData as $row) {
            try {
                if (is_array($row[0])) {
                    $this->upsertStart();
                    continue;
                }

                if ($this->isFirstRow($row)) continue;

                if (!$this->isValid($row)) {
                    $this->catchError($row, configText("import_validation_invalid"));
                    continue;
                }

                if ($this->isExist($row)) {
                    $this->catchError($row, configText("import_data_exist"));
                    continue;
                }

                $this->importedData[] = $this->createImportData($row);

                if (count($this->importedData) >= $this->threshold) {
                    $this->upsert($this->importedData);
                    $this->importedData = [];
                }

                $this->count++;
            } catch (\Exception $e) {
                $this->catchError($row, $e->getMessage());
            }
        }

        if (count($this->importedData) > 0) $this->upsert($this->importedData);

        emphasisLogEnd("IMPORT " . className($this));

        if (!empty($this->errors)) $this->throwException();
    }

    final private function catchError(array $row, string $errorMessage): void
    {
        $error = $this->createError($row, $errorMessage);

        $this->errorLog($error);

        $this->addError($error);
    }

    final private function createError(array $row, string $errorMessage): ImportError
    {
        return new ImportError($errorMessage, $row);
    }

    final private function addError(ImportError $error): void
    {
        $this->errors[] = $error;
    }

    final public function isWriteErrorLog(bool $writeErrorLogFlg): BaseImport
    {
        $this->writeErrorLogFlg = $writeErrorLogFlg;
        return $this;
    }

    final public function isThrowException(bool $throwExceptionFlg): BaseImport
    {
        $this->throwExceptionFlg = $throwExceptionFlg;
        return $this;
    }

    final private function errorLog(ImportError $error): void
    {
        if (!$this->writeErrorLogFlg) return;

        errorLog(configText("import_error"));
        errorLog("caused: " . $error->errorText);
        errorLog("params: " . json_encode($error->row, JSON_UNESCAPED_UNICODE));
    }

    final private function throwException(): void
    {
        if (!$this->throwExceptionFlg) return;

        throw new ImportException(configText("import_error"), $this->errors);
    }

    final public function count(): int
    {
        return $this->count;
    }

    final public function errors(): array
    {
        return $this->errors;
    }

    final public function hasErrors(): bool
    {
        return !empty($this->errors);
    }
}
