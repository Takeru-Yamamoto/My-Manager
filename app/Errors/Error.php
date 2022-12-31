<?php

namespace App\Errors;

class Error
{
    public string $errorText;

    function __construct(string $errorText)
    {
        $this->errorText = $errorText;
    }
}
