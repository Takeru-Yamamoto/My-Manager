<?php

namespace App\Http\Forms\User;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class ChangeIsValidForm extends BaseForm
{
    public $id;
    public $isValid;

    protected function validationRule(): array
    {
        return [
            'id'  => 'required|' . Rule::VALUE_POSITIVE_INTEGER,
            'flg' => 'required|' . Rule::FLG_INTEGER,
        ];
    }

    protected function bind(array $input): void
    {
        $this->id      = intval($input['id']);
        $this->isValid = intval($input['flg']);
    }
    
    protected function validateAfterBinding(): void
    {
    }
}
