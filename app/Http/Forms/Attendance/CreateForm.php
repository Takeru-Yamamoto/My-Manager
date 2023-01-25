<?php

namespace App\Http\Forms\Attendance;

use App\Http\Forms\BaseForm;

class CreateForm extends BaseForm
{
    public $type;
    public $relation;

    protected function validationRule(): array
    {
        return [
            'type'     => $this->required($this->string()),
            'relation' => $this->nullable($this->integer()),
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
