<?php

namespace App\Http\Forms\PasswordForgot;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class PasswordResetPreparationForm extends BaseForm
{
    public $token;
    public $email;

    protected function validationRule(): array
    {
        return [
            'token' => 'required|' . Rule::VALUE_TEXT,
            'email' => 'required|' . Rule::EMAIL,
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
