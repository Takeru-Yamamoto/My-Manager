<?php

namespace App\Http\Forms\PasswordForgot;

use App\Http\Forms\BaseForm;

class PasswordResetPreparationForm extends BaseForm
{
    public $token;
    public $email;

    protected function validationRule(): array
    {
        return [
            'token' => required(validationString()),
            'email' => required(validationEmail()),
        ];
    }

    protected function bind(array $input): void
    {
        $this->token = strval($input['token']);
        $this->email = strval($input['email']);
    }

    protected function validateAfterBinding(): void
    {
    }
}
