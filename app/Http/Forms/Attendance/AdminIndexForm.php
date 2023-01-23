<?php

namespace App\Http\Forms\Attendance;

use App\Http\Forms\BaseForm;

class AdminIndexForm extends BaseForm
{
    public $page;
    public $name;
    public $month;
    public $isValid;

    protected function validationRule(): array
    {
        return [
            'page'     => nullable(validationInteger()),
            'name'     => nullable(validationString()),
            'month'    => nullable(validationMonth()),
            'is_valid' => nullable(validationTinyInteger()),
        ];
    }

    protected function bind(array $input): void
    {
        $this->page    = isset($input['page']) ? intval($input['page']) : 1;
        $this->name    = isset($input['name']) ? strval($input['name']) : null;
        $this->month   = isset($input['month']) ? strval($input['month']) : null;
        $this->isValid = isset($input['is_valid']) ? intval($input['is_valid']) : null;
    }
    
    protected function validateAfterBinding(): void
    {
    }
}
