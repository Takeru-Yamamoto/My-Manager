<?php

namespace App\Exceptions;

class DBUtilException extends \Exception
{
    public function __construct(string $message, \Exception $previous)
    {
        parent::__construct($message, 0, $previous);
    }
}