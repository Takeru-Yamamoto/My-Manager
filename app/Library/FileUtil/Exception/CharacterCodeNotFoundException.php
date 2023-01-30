<?php

namespace App\Library\FileUtil\Exceptions;

class CharacterCodeNotFoundException extends \Exception
{
    public function __construct(string $filePath)
    {
        parent::__construct("文字コードが判定できませんでした。 filePath: " . $filePath);
    }
}
