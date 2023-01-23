<?php

namespace App\Http\Forms\Attendance;

use App\Http\Forms\BaseForm;

class IndexForm extends BaseForm
{
    public $page;
    public $month;

    protected function validationRule(): array
    {
        return [
            'page'  => nullable(validationInteger()),
            'month' => nullable(validationMonth()),
        ];
    }

    protected function bind(array $input): void
    {
        $this->page  = isset($input['page']) ? intval($input['page']) : 1;
        $this->month = isset($input['month']) ? strval($input['month']) : null;
    }
    
    protected function validateAfterBinding(): void
    {
    }
}
