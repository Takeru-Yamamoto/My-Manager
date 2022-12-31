<?php

namespace App\Http\Forms\User;

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
            'id'       => 'required|' . Rule::VALUE_INTEGER,
            'email'    => 'required|' . Rule::EMAIL,
            'password' => 'nullable|confirmed|' . Rule::VALUE_STRING,
            'role'     => 'required|' . Rule::VALUE_INTEGER,
        ];
    }

    protected function bind(array $input): void
    {
        $this->id       = intval($input['id']);
        $this->email    = strval($input['email']);
        $this->password = isset($input['password']) ? strval($input['password']) : null;
        $this->role     = intval($input['role']);
    }
    
    protected function validateAfterBinding(): void
    {
    }
}
