<?php

namespace App\Exceptions;

use App\Http\Forms\BaseForm;

class InvalidFormException extends \Exception
{
    public function __construct(BaseForm $form)
    {
        parent::__construct(implode("\n", $form->errors));
    }
}
