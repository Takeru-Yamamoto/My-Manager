<?php

namespace App\Http\Forms\Attendance;

use App\Http\Forms\BaseForm;

class AdminIndexForm extends BaseForm
{
    public $page;
    public $name;
    public $month;
    public $isValid;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            'page'     => $this->nullable($this->integer()),
            'name'     => $this->nullable($this->string()),
            'month'    => $this->nullable($this->month()),
            'is_valid' => $this->nullable($this->tinyInteger()),
        ];
    }

    protected function bind(): void
    {
        $this->page    = isset($this->input['page']) ? intval($this->input['page']) : 1;
        $this->name    = isset($this->input['name']) ? strval($this->input['name']) : null;
        $this->month   = isset($this->input['month']) ? strval($this->input['month']) : null;
        $this->isValid = isset($this->input['is_valid']) ? intval($this->input['is_valid']) : null;
    }

    protected function afterBinding(): void
    {
    }
}
