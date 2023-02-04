<?php

namespace App\Http\Forms\TaskColor;

use App\Http\Forms\BaseForm;

class UpdateForm extends BaseForm
{
    public $id;
    public $color;
    public $description;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            'id'          => $this->required($this->id("task_colors")),
            'color'       => $this->required($this->string()),
            'description' => $this->required($this->string()),
        ];
    }

    protected function bind(): void
    {
        $this->id          = intval($this->input['id']);
        $this->color       = strval($this->input['color']);
        $this->description = strval($this->input['description']);
    }

    protected function afterBinding(): void
    {
    }
}
