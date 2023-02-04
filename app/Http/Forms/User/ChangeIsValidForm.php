<?php

namespace App\Http\Forms\User;

use App\Http\Forms\BaseForm;

class ChangeIsValidForm extends BaseForm
{
    public $id;
    public $isValid;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            "id"  => $this->required($this->userId()),
            "flg" => $this->required($this->tinyInteger()),
        ];
    }

    protected function bind(): void
    {
        $this->id      = intval($this->input["id"]);
        $this->isValid = intval($this->input["flg"]);
    }
    
    protected function afterBinding(): void
    {
    }
}
