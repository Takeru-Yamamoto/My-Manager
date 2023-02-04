<?php

namespace App\Http\Forms\User;

use App\Http\Forms\BaseForm;

class UpdateForm extends BaseForm
{
    public $id;
    public $email;
    public $password;
    public $role;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            "id"       => $this->required($this->userId()),
            "email"    => $this->required($this->email()),
            "password" => $this->nullable($this->passwordConfirmed()),
            "role"     => $this->required($this->integer()),
        ];
    }

    protected function bind(): void
    {
        $this->id       = intval($this->input["id"]);
        $this->email    = strval($this->input["email"]);
        $this->password = isset($this->input["password"]) ? strval($this->input["password"]) : null;
        $this->role     = intval($this->input["role"]);
    }
    
    protected function afterBinding(): void
    {
    }
}
