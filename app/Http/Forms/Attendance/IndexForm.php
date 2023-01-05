<?php

namespace App\Http\Forms\Attendance;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class IndexForm extends BaseForm
{
    public $month;
    public $page;

    protected function validationRule(): array
    {
        return [
            'month' => 'nullable|' . Rule::VALUE_STRING,
            'page'  => 'nullable|' . Rule::VALUE_INTEGER,
        ];
    }

    protected function bind(array $input): void
    {
        $this->month = isset($input['month']) ? strval($input['month']) : null;
        $this->page  = isset($input['page']) ? intval($input['page']) : 1;
    }
    
    protected function validateAfterBinding(): void
    {
    }
}
