<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class UpdateTaskColorForm extends BaseForm
{
    public $id;
    public $color;
    public $description;

    protected function validationRule(): array
    {
        return [
            'id'          => 'required|' . Rule::INTEGER,
            'color'       => 'required|' . Rule::STRING,
            'description' => 'required|' . Rule::STRING,
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
