<?php

namespace App\Exceptions;

class InvalidFormException extends \Exception
{
    public function __construct(\App\Http\Forms\BaseForm $form)
    {
        $errorText = "";
        $errors = $form->errors;

        foreach ($errors as $error) {
            $errorText .= $error . "\n";
        }

        if (!empty($errorText)) $errorText = removeFromEnd($errorText, 2);

        parent::__construct($errorText);
    }
}
