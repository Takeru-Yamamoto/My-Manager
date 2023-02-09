<?php

namespace App\Http\Forms\PasswordForgot;

use App\Http\Forms\BaseForm;

class PasswordResetPreparationForm extends BaseForm
{
    public $token;
    public $email;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            "token" => $this->required($this->string(), $this->exists("password_resets", "token")->where("email", $this->input["email"])),
            "email" => $this->required($this->email(), $this->exists("password_resets", "email")->where("token", $this->input["token"])),
        ];
    }

    protected function bind(): void
    {
        $this->token = strval($this->input["token"]);
        $this->email = strval($this->input["email"]);
    }

    protected function afterBinding(): void
    {
    }
}
