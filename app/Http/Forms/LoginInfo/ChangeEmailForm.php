<?php

namespace App\Http\Forms\LoginInfo;

use App\Http\Forms\BaseForm;

class ChangeEmailForm extends BaseForm
{
    public $userId;
    public $authenticationCode;

    protected function validationRule(): array
    {
        return [
            'user_id'             => $this->required($this->userId()),
            'authentication_code' => $this->required($this->code(6)),
        ];
    }

    protected function bind(array $input): void
    {
        $this->userId             = strval($input['user_id']);
        $this->authenticationCode = strval($input['authentication_code']);
    }


    protected function validateAfterBinding(): void
    {
    }
}
