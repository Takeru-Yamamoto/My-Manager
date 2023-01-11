<?php

namespace App\Http\Forms\User;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class IndexForm extends BaseForm
{
    public $page;

    protected function validationRule(): array
    {
        return [
            'page'  => 'nullable|' . Rule::VALUE_INTEGER,
        ];
    }

    protected function bind(array $input): void
    {
        $this->page  = isset($input['page']) ? intval($input['page']) : 1;
    }
    
    protected function validateAfterBinding(): void
    {
    }
}
