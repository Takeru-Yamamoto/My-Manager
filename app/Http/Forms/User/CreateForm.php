<?php

namespace App\Http\Forms\User;

use App\Http\Forms\BaseForm;

use App\Repositories\UserRepository;
use App\Consts\TextConst;

class CreateForm extends BaseForm
{
    public $name;
    public $email;
    public $password;
    public $role;

    protected function validationRule(): array
    {
        return [
            'name'     => $this->required($this->string()),
            'email'    => $this->required($this->email()),
            'password' => $this->required($this->passwordConfirmed()),
            'role'     => $this->required($this->integer()),
        ];
    }

    protected function bind(array $input): void
    {
        $this->name     = strval($input['name']);
        $this->email    = strval($input['email']);
        $this->password = strval($input['password']);
        $this->role     = intval($input['role']);
    }

    protected function validateAfterBinding(): void
    {
        $repository   = new UserRepository();

        if ($repository->where("name", $this->name)->isExist()) $this->addError(getTextFromConst(TextConst::USER_NAME_EXIST));
        if ($repository->where("email", $this->email)->isExist()) $this->addError(getTextFromConst(TextConst::EMAIL_ADDRESS_EXIST));
    }
}
