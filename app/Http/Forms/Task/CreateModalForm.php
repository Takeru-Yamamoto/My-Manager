<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;

class CreateModalForm extends BaseForm
{
    public $startDate;
    public $endDate;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            'start_date' => $this->required($this->date(), $this->before("end_date")),
            'end_date'   => $this->required($this->date(), $this->after("start_date")),
        ];
    }

    protected function bind(): void
    {
        $this->startDate = strval($this->input['start_date']);
        $this->endDate   = strval($this->input['end_date']);
    }
    
    protected function afterBinding(): void
    {
    }
}
