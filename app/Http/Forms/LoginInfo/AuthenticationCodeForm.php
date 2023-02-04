<?php

namespace App\Http\Forms\LoginInfo;

use App\Http\Forms\BaseForm;

class AuthenticationCodeForm extends BaseForm
{
    public $userId;
    public $email;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            "user_id" => $this->required($this->userId()),
            "email"   => $this->required($this->email(), $this->unique("users")),
        ];
    }

    protected function bind(): void
    {
        $this->userId = strval($this->input["user_id"]);
        $this->email  = strval($this->input["email"]);
    }

    protected function afterBinding(): void
    {
    }
}
