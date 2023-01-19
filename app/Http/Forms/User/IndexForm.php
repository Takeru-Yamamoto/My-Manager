<?php

namespace App\Http\Forms\User;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class IndexForm extends BaseForm
{
    public $page;
    public $name;
    public $isValid;

    protected function validationRule(): array
    {
        return [
            'page' => 'nullable|' . Rule::INTEGER,
            'name' => 'nullable|' . Rule::STRING,
            'is_valid'   => 'nullable|' . Rule::INTEGER,
        ];
    }

    protected function bind(array $input): void
    {
        $this->page    = isset($input['page']) ? intval($input['page']) : 1;
        $this->name    = isset($input['name']) ? strval($input['name']) : null;
        $this->isValid = isset($input['is_valid']) ? intval($input['is_valid']) : null;
    }
    
    protected function validateAfterBinding(): void
    {
    }
}
