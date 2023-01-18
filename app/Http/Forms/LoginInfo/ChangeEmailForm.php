<?php

namespace App\Http\Forms\LoginInfo;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class ChangeEmailForm extends BaseForm
{
    public $userId;
    public $authenticationCode;

    protected function validationRule(): array
    {
        return [
            'user_id'             => 'required|' . Rule::POSITIVE_NON_ZERO,
            'authentication_code' => 'required|' . Rule::SIX_DIGIT_CODE,
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
