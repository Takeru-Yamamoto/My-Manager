<?php

namespace App\Http\Forms\User;

use App\Http\Forms\BaseForm;

class ChangeIsValidForm extends BaseForm
{
    public $id;
    public $isValid;

    protected function validationRule(): array
    {
        return [
            'id'  => $this->required($this->userId()),
            'flg' => $this->required($this->tinyInteger()),
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
