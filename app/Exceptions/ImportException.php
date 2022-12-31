<?php

namespace App\Exceptions;

use App\Errors\ImportError;

class ImportException extends \Exception
{
    public function __construct(string $errorText, array $errors)
    {
        foreach ($errors as $error) {
            if (!$error instanceof ImportError) continue;
            
            $errorText .= "\n". $error->errorText;
        }

        parent::__construct($errorText);
    }
}
