<?php

namespace App\Http\Forms\TaskColor;

use App\Http\Forms\BaseForm;

class UpdateForm extends BaseForm
{
    public $id;
    public $color;
    public $description;

    protected function validationRule(): array
    {
        return [
            'id'          => $this->required($this->id("task_colors")),
            'color'       => $this->required($this->string()),
            'description' => $this->required($this->string()),
        ];
    }

    protected function bind(array $input): void
    {
        $this->id          = intval($input['id']);
        $this->color       = strval($input['color']);
        $this->description = strval($input['description']);
    }

    protected function validateAfterBinding(): void
    {
    }
}
