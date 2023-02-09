<?php

namespace App\Http\Forms\PasswordForgot;

use App\Http\Forms\BaseForm;

class ReceiveEmailAddressForm extends BaseForm
{
    public $email;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            "email" => $this->required($this->email(), $this->exists("users", "email")),
        ];
    }

    protected function bind(): void
    {
        $this->email = strval($this->input["email"]);
    }

    protected function afterBinding(): void
    {
    }
}
