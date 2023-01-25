<?php

namespace App\Http\Forms\LoginInfo;

use App\Http\Forms\BaseForm;

class UpdateForm extends BaseForm
{
    public $id;
    public $email;
    public $password;
    public $role;

    protected function validationRule(): array
    {
        return [
            'id'       => $this->required($this->userId()),
            'email'    => $this->required($this->email()),
            'password' => $this->nullable($this->passwordConfirmed()),
            'role'     => $this->required($this->integer()),
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
