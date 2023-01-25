<?php

namespace App\Http\Forms\PasswordForgot;

use App\Http\Forms\BaseForm;

class ReceiveEmailAddressForm extends BaseForm
{
    public $email;

    protected function validationRule(): array
    {
        return [
            'email' => $this->required($this->email()),
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
