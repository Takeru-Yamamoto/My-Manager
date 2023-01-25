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
            'token' => $this->required($this->string()),
            'email' => $this->required($this->email()),
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
