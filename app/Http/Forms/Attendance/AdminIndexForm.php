<?php

namespace App\Http\Forms\Attendance;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class AdminIndexForm extends BaseForm
{
    public $name;
    public $month;
    public $page;

    protected function validationRule(): array
    {
        return [
            'name'  => 'nullable|' . Rule::STRING,
            'month' => 'nullable|' . Rule::MONTH,
            'page'  => 'nullable|' . Rule::INTEGER,
        ];
    }

    protected function bind(array $input): void
    {
        $this->name  = isset($input['name']) ? strval($input['name']) : null;
        $this->month = isset($input['month']) ? strval($input['month']) : null;
        $this->page  = isset($input['page']) ? intval($input['page']) : 1;
    }
    
    protected function validateAfterBinding(): void
    {
    }
}
