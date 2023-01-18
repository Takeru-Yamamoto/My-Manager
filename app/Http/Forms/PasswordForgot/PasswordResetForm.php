<?php

namespace App\Http\Forms\PasswordForgot;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class PasswordResetForm extends BaseForm
{
    public $password;
    public $email;
    public $token;

    protected function validationRule(): array
    {
        return [
            'password' => 'required|confirmed|' . Rule::PASSWORD,
            'email' => 'required|' . Rule::EMAIL,
            'token' => 'required|' . Rule::TEXT,
        ];
    }

    protected function bind(array $input): void
    {
        $this->password = strval($input['password']);
        $this->email = strval($input['email']);
        $this->token = strval($input['token']);
    }

    protected function validateAfterBinding(): void
    {
    }
}
