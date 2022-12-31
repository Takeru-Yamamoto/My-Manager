<?php

namespace App\Errors;

use App\Errors\Error;

class ImportError extends Error
{
    public array $row;

    function __construct(string $errorText, array $row)
    {
        parent::__construct($errorText);

        $this->row = $row;
    }
}
