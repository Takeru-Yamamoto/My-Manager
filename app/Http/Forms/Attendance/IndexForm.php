<?php

namespace App\Http\Forms\Attendance;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class IndexForm extends BaseForm
{
    public $month;
    public $page;
    public $path;

    protected function validationRule(): array
    {
        return [
            'month' => 'nullable|' . Rule::VALUE_STRING,
            'page'  => 'nullable|' . Rule::VALUE_INTEGER,
            'path'  => 'required|' . Rule::VALUE_STRING,
        ];
    }

    protected function bind(array $input): void
    {
        $this->month = isset($input['month']) ? strval($input['month']) : null;
        $this->page  = isset($input['page']) ? intval($input['page']) : 1;
        $this->path  = strval($input['path']);
    }
    
    protected function validateAfterBinding(): void
    {
    }
}
