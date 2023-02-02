<?php

namespace App\Library\FileUtil\Exception;

class CharacterCodeNotFoundException extends \Exception
{
    public function __construct(string $filePath)
    {
        parent::__construct("文字コードが判定できませんでした。 filePath: " . $filePath);
    }
}
