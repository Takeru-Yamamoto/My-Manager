<?php

namespace App\Http\Forms\User;

use App\Http\Forms\BaseForm;

class IndexForm extends BaseForm
{
    public $page;
    public $name;
    public $isValid;

    protected function validationRule(): array
    {
        return [
            'page'     => $this->nullable($this->integer()),
            'name'     => $this->nullable($this->string()),
            'is_valid' => $this->nullable($this->tinyInteger()),
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
