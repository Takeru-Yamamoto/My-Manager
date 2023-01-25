<?php

namespace App\Http\Forms\LoginInfo;

use App\Http\Forms\BaseForm;

class AuthenticationCodeForm extends BaseForm
{
    public $userId;
    public $email;

    protected function validationRule(): array
    {
        return [
            'user_id' => $this->required($this->userId()),
            'email'   => $this->required($this->email()),
        ];
    }

    protected function bind(array $input): void
    {
        $this->userId = strval($input['user_id']);
        $this->email  = strval($input['email']);
    }

    protected function validateAfterBinding(): void
    {
    }
}
