<?php

namespace App\Library\FileUtil;

use App\Library\FileUtil\FileManager;

abstract class StorageFile extends FileManager
{
    function __construct(string $dirName, string $baseName)
    {
        $this->set($dirName, $baseName);
    }

    final private function set(string $dirName, string $baseName): void
    {
        $this->setFileManager(
            $dirName,
            $baseName,
        );

        if (!$this->isExist()) throw $this->StorageFileNotFoundException();
    }

    abstract public function save(string $dirName, string $baseName): self;
    abstract protected function setChild(): void;
    abstract public function params(): array;

    public function saveRename(string $registerName): self
    {
        return $this->save($this->dirName, $registerName);
    }

    public function saveOverride(): self
    {
        return $this->save($this->dirName, $this->baseName);
    }

    final protected function reset(string $dirName, string $baseName): void
    {
        $this->delete();
        $this->set($dirName, $baseName);
        $this->setChild();
    }
}
