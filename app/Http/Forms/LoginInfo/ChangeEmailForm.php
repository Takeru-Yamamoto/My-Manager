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
            'user_id'             => required(validationUserId()),
            'authentication_code' => required(validationCode(6)),
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
