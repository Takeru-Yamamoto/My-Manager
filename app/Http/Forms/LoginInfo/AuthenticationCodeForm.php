<?php

namespace App\Http\Forms\LoginInfo;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class AuthenticationCodeForm extends BaseForm
{
    public $userId;
    public $email;

    protected function validationRule(): array
    {
        return [
            'user_id' => 'required|' . Rule::POSITIVE_NON_ZERO,
            'email'   => 'required|' . Rule::EMAIL,
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
