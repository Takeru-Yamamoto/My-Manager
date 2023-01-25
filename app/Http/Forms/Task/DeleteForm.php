<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;

class DeleteForm extends BaseForm
{
    public $id;

    protected function validationRule(): array
    {
        return [
            'id' => $this->required($this->id("tasks")),
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
