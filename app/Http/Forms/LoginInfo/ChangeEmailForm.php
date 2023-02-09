<?php

namespace App\Http\Forms\LoginInfo;

use App\Http\Forms\BaseForm;

class ChangeEmailForm extends BaseForm
{
    public $userId;
    public $authenticationCode;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            "user_id"             => $this->required($this->userId(), $this->exists("email_resets", "user_id")->where("authentication_code", $this->input["authentication_code"])),
            "authentication_code" => $this->required($this->code(6), $this->exists("email_resets", "authentication_code")->where("user_id", $this->input["user_id"])),
        ];
    }

    protected function bind(): void
    {
        $this->userId             = strval($this->input["user_id"]);
        $this->authenticationCode = strval($this->input["authentication_code"]);
    }


    protected function afterBinding(): void
    {
    }
}
