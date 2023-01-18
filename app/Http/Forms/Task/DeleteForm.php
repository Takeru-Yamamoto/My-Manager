<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class DeleteForm extends BaseForm
{
    public $id;

    protected function validationRule(): array
    {
        return [
            'id' => 'required|' . Rule::INTEGER,
        ];
    }

    protected function bind(array $input): void
    {
        $this->id = intval($input['id']);
    }

    protected function validateAfterBinding(): void
    {
    }
}
