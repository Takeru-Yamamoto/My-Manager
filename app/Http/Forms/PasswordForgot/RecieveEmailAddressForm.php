<?php

namespace App\Http\Forms\PasswordForgot;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class RecieveEmailAddressForm extends BaseForm
{
    public $email;

    protected function validationRule(): array
    {
        return [
            'email' => 'required|' . Rule::EMAIL,
        ];
    }

    protected function bind(array $input): void
    {
        $this->email = strval($input['email']);
    }

    protected function validateAfterBinding(): void
    {
    }
}
