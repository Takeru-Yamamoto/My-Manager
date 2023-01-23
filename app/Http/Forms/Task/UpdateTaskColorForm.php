<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;

class UpdateTaskColorForm extends BaseForm
{
    public $id;
    public $color;
    public $description;

    protected function validationRule(): array
    {
        return [
            'id'          => required(validationId("task_colors")),
            'color'       => required(validationString()),
            'description' => required(validationString()),
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
