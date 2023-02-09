<?php

namespace App\Http\Forms\PasswordForgot;

use App\Http\Forms\BaseForm;

class PasswordResetForm extends BaseForm
{
    public $password;
    public $email;
    public $token;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            "password" => $this->required($this->passwordConfirmed()),
            "email"    => $this->required($this->email(), $this->exists("users", "email")),
            "token"    => $this->required($this->string()),
        ];
    }

    protected function bind(): void
    {
        $this->password = strval($this->input["password"]);
        $this->email    = strval($this->input["email"]);
        $this->token    = strval($this->input["token"]);
    }

    protected function afterBinding(): void
    {
    }
}
