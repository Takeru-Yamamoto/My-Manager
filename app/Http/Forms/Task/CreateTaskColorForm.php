<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class CreateTaskColorForm extends BaseForm
{
    public $color;
    public $description;

    protected function validationRule(): array
    {
        return [
            'color'       => 'required|' . Rule::STRING,
            'description' => 'required|' . Rule::STRING,
        ];
    }

    protected function bind(array $input): void
    {
        $this->color       = strval($input['color']);
        $this->description = strval($input['description']);
    }

    protected function validateAfterBinding(): void
    {
    }
}
