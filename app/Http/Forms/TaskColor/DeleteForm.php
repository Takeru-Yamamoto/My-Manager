<?php

namespace App\Http\Forms\TaskColor;

use App\Http\Forms\BaseForm;

class DeleteForm extends BaseForm
{
    public $id;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            'id' => $this->required($this->id("task_colors")),
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
