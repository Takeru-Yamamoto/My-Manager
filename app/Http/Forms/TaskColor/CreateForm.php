<?php

namespace App\Http\Forms\TaskColor;

use App\Http\Forms\BaseForm;

class CreateForm extends BaseForm
{
    public $color;
    public $description;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            'color'       => $this->required($this->string()),
            'description' => $this->required($this->string()),
        ];
    }

    protected function bind(): void
    {
        $this->color       = strval($this->input['color']);
        $this->description = strval($this->input['description']);
    }

    protected function afterBinding(): void
    {
    }
}
