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

    function __construct(string $dirName, string $baseName)
    {
        parent::__construct($dirName, $baseName);

        $this->setChild();
    }

    public function save(string $dirName, string $baseName): self
    {
        $this->file->save($dirName . "/" . $baseName);
        $this->reset($dirName, $baseName);
        return $this;
    }
    protected function setChild(): void
    {
        $ffmpeg     = FFMpeg::open($this->filePath);
        $this->file = $ffmpeg->export()->toDisk("public");

        $stream        = $ffmpeg->getVideoStream();
        $this->width   = $stream->get("width");
        $this->height  = $stream->get("height");
        $this->seconds = $stream->getDurationInSeconds();
    }

    public function params(): array
    {
        $params = [
            "width"    => $this->width(),
            "height"   => $this->height(),
            "seconds" => $this->seconds(),
        ];

        return array_merge($params, parent::params());
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
        $this->setFileManager($this->dirName, $this->fileName . "." . $extension);
        return $this;
    }
    public function encodeMP4(): self
    {
        return $this->encode(new Format\X264(), "mp4");
    }
    public function encodeWEBM(): self
    {
        return $this->encode(new Format\WebM(), "webm");
    }
}
