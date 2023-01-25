<?php

namespace App\Http\Forms\PasswordForgot;

use App\Http\Forms\BaseForm;

class PasswordResetForm extends BaseForm
{
    public $password;
    public $email;
    public $token;

    protected function validationRule(): array
    {
        return [
            'password' => $this->required($this->passwordConfirmed()),
            'email'    => $this->required($this->email()),
            'token'    => $this->required($this->string()),
        ];
    }

    protected function bind(array $input): void
    {
        $this->password = strval($input['password']);
        $this->email    = strval($input['email']);
        $this->token    = strval($input['token']);
    }

    protected function validateAfterBinding(): void
    {
    }
}
