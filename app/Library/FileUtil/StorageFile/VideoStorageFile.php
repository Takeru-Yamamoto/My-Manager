<?php

namespace App\Library\FileUtil\StorageFile;

use App\Library\FileUtil\StorageFile;

use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use ProtoneMedia\LaravelFFMpeg\Exporters\MediaExporter;

use FFMpeg\Format\FormatInterface;
use FFMpeg\Format\Video as Format;

final class VideoStorageFile extends StorageFile
{
    public MediaExporter $file;

    private int $width;
    private int $height;
    private int $seconds;

    function __construct(string $uploadDirectory, string $fileName)
    {
        parent::__construct($uploadDirectory, $fileName);

        $this->setChild();
    }

    public function save(string $uploadDirectory, string $fileName): self
    {
        $this->file->save($uploadDirectory . "/" . $fileName);
        $this->reset($uploadDirectory, $fileName);
        return $this;
    }
    protected function setChild(): void
    {
        $ffmpeg     = FFMpeg::fromdisk("local")->open($this->filePath);
        $this->file = $ffmpeg->export()->toDisk("local");

        $stream        = $ffmpeg->getVideoStream();
        $this->width   = $stream->get("width");
        $this->height  = $stream->get("height");
        $this->seconds = $stream->getDurationInSeconds();
    }
    protected function childParams(): array
    {
        return [
            "width"   => $this->width(),
            "height"  => $this->height(),
            "seconds" => $this->seconds(),
        ];
    }

    public function width(): int
    {
        return $this->width;
    }
    public function height(): int
    {
        return $this->height;
    }
    public function seconds(): int
    {
        return $this->seconds;
    }


    // 動画の形式を変更する
    private function encode(FormatInterface $format, string $extension): self
    {
        $this->file = $this->file->inFormat($format);
        $this->resetFileName($this->name . "." . $extension);
        return $this;
    }
    public function encodeMP4(): self
    {
        return $this->encode(new Format\X264(), "mp4");
    }
    public function encodeWEBM(): self
    {
        return $this->encode(new Format\WebM(),"webm");
    }
}
