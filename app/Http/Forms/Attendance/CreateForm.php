<?php

namespace App\Http\Forms\Attendance;

use App\Http\Forms\BaseForm;

class CreateForm extends BaseForm
{
    public $type;
    public $relation;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            'type'     => $this->required($this->string()),
            'relation' => $this->nullable($this->integer()),
        ];
    }

    protected function bind(): void
    {
        $this->type     = strval($this->input['type']);
        $this->relation = isset($this->input['relation']) ? intval($this->input['relation']) : null;
    }

    protected function afterBinding(): void
    {
    }
}
