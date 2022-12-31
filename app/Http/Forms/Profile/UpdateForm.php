<?php

namespace App\Http\Forms\Profile;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class UpdateForm extends BaseForm
{
    public $id;
    public $createdBy;

    protected function validationRule(): array
    {
        return [
            'id'         => 'required|' . Rule::VALUE_INTEGER,
            'created_by' => 'required|' . Rule::VALUE_INTEGER,
        ];
    }

    protected function bind(array $input): void
    {
        $this->id        = intval($input['id']);
        $this->createdBy = intval($input['created_by']);
    }
    
    protected function validateAfterBinding(): void
    {
    }
}
