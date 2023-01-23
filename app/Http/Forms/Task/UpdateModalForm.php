<?php

namespace App\Http\Forms\Task;

use App\Http\Forms\BaseForm;

class UpdateModalForm extends BaseForm
{
    public $id;

    protected function validationRule(): array
    {
        return [
            'id' => required(validationId("tasks")),
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
