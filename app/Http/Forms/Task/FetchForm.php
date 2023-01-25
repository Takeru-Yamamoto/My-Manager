<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;

class FetchForm extends BaseForm
{
    public $startDate;
    public $endDate;

    protected function validationRule(): array
    {
        return [
            'start_date' => $this->required($this->date()),
            'end_date'   => $this->required($this->date()),
        ];
    }

    protected function bind(array $input): void
    {
        $this->startDate = strval($input['start_date']);
        $this->endDate   = strval($input['end_date']);
    }
    
    protected function validateAfterBinding(): void
    {
    }
}
