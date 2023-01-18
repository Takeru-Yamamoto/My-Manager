<?php

namespace App\Http\Forms\LoginInfo;

use App\Http\Forms\BaseForm;
use App\Http\Forms\ValidationRule as Rule;

class UpdateForm extends BaseForm
{
    public $id;
    public $email;
    public $password;
    public $role;

    protected function validationRule(): array
    {
        return [
            'id'       => 'required|' . Rule::INTEGER,
            'email'    => 'required|' . Rule::EMAIL,
            'password' => 'nullable|confirmed|' . Rule::STRING,
            'role'     => 'required|' . Rule::INTEGER,
        ];
    }

    protected function bind(array $input): void
    {
        $this->id       = intval($input['id']);
        $this->email    = isset($input['email']) ? strval($input['email']) : null;
        $this->password = isset($input['password']) ? strval($input['password']) : null;
        $this->role     = intval($input['role']);
    }
    
    protected function validateAfterBinding(): void
    {
    }
}
