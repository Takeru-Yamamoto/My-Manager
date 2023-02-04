<?php

namespace App\Http\Forms\User;

use App\Http\Forms\BaseForm;

class CreateForm extends BaseForm
{
    public $name;
    public $email;
    public $password;
    public $role;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            "name"     => $this->required($this->string(), $this->unique("users", "name")),
            "email"    => $this->required($this->email(), $this->unique("users", "email")),
            "password" => $this->required($this->passwordConfirmed()),
            "role"     => $this->required($this->integer()),
        ];
    }

    protected function bind(): void
    {
        $this->name     = strval($this->input["name"]);
        $this->email    = strval($this->input["email"]);
        $this->password = strval($this->input["password"]);
        $this->role     = intval($this->input["role"]);
    }

    protected function afterBinding(): void
    {
    }
}
