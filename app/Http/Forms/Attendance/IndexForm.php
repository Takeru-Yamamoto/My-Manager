<?php

namespace App\Http\Forms\Attendance;

use App\Http\Forms\BaseForm;

class IndexForm extends BaseForm
{
    public $page;
    public $month;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            'page'  => $this->nullable($this->integer()),
            'month' => $this->nullable($this->month()),
        ];
    }

    protected function bind(): void
    {
        $this->page  = isset($this->input['page']) ? intval($this->input['page']) : 1;
        $this->month = isset($this->input['month']) ? strval($this->input['month']) : null;
    }
    
    protected function afterBinding(): void
    {
    }
}
