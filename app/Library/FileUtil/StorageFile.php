<?php

namespace App\Library\FileUtil;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Library\FileUtil\Exception\StorageFileNotFoundException;

abstract class StorageFile
{
    protected string $uploadDirectory;
    protected string $fileName;
    protected string $filePath;

    protected string $name;
    protected string $extension;

    function __construct(string $uploadDirectory, string $fileName)
    {
        $this->set($uploadDirectory, $fileName);
    }

    final private function set(string $uploadDirectory, string $fileName): void
    {
        $this->uploadDirectory = $uploadDirectory;
        $this->fileName        = $fileName;
        $this->filePath        = $uploadDirectory . "/" . $fileName;

        $this->setNameExtension($fileName);

        if (!$this->isExist()) throw new StorageFileNotFoundException($this->filePath);
    }

    abstract public function save(string $uploadDirectory, string $fileName): self;
    abstract protected function setChild(): void;
    abstract protected function childParams(): array;

    public function saveRename(string $fileName): self
    {
        return $this->save($this->uploadDirectory, $fileName);
    }

    public function saveOverride(): self
    {
        return $this->save($this->uploadDirectory, $this->fileName);
    }

    final protected function setNameExtension(string $fileName): void
    {
        $exploded        = explode(".", $fileName);
        $this->extension = end($exploded);
        $this->name      = str_replace("." . $this->extension, "", $fileName);
    }

    final protected function reset(string $uploadDirectory, string $fileName): void
    {
        $this->delete();
        $this->set($uploadDirectory, $fileName);
        $this->setChild();
    }

    final protected function resetFileName(string $newFileName): void
    {
        $oldFileName = $this->fileName;

        $this->fileName = $newFileName;
        $this->filePath = str_replace($oldFileName, $newFileName, $this->filePath);

        $this->setNameExtension($newFileName);
    }

    final protected function resetUploadDirectory(string $newUploadDirectory): void
    {
        $oldUploadDirectory = $this->uploadDirectory;

        $this->uploadDirectory = $newUploadDirectory;
        $this->filePath        = str_replace($oldUploadDirectory, $newUploadDirectory, $this->filePath);
    }

    final public function uploadDirectory(): string
    {
        return $this->uploadDirectory;
    }

    final public function filePath(): string
    {
        return $this->filePath;
    }

    final public function download(): StreamedResponse
    {
        return Storage::download($this->filePath);
    }

    final public function delete(): bool
    {
        return Storage::delete($this->filePath);
    }

    final public function isExist(): bool
    {
        return Storage::exists($this->filePath);
    }

    final public function params(): array
    {
        $params = [
            "fileName"  => $this->name(),
            "name"      => $this->name(),
            "extension" => $this->extension(),
        ];

        return array_merge($params, $this->childParams());
    }

    final public function fileName(): string
    {
        return $this->fileName;
    }

    final public function name(): string
    {
        return $this->name;
    }

    final public function extension(): string
    {
        return $this->extension;
    }
}
