<?php

namespace App\Http\Forms\Attendance;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class CreateForm extends BaseForm
{
    public $type;
    public $relation;

    protected function validationRule(): array
    {
        return [
            'type'     => 'required|' . Rule::STRING,
            'relation' => 'nullable|' . Rule::INTEGER,
        ];
    }

    protected function bind(array $input): void
    {
        $this->type     = strval($input['type']);
        $this->relation = isset($input['relation']) ? intval($input['relation']) : null;
    }

    protected function validateAfterBinding(): void
    {
    }
}
