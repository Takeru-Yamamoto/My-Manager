<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;

class UpdateModalForm extends BaseForm
{
    public $id;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            'id' => $this->required($this->id("tasks")),
        ];
    }

    protected function bind(): void
    {
        $this->id = intval($this->input['id']);
    }
    
    protected function afterBinding(): void
    {
    }
}
