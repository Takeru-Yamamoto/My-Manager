<?php

namespace App\Http\Forms\User;

use App\Http\Forms\BaseForm;

class IndexForm extends BaseForm
{
    public $page;
    public $name;
    public $isValid;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            "page"     => $this->nullable($this->integer()),
            "name"     => $this->nullable($this->string()),
            "is_valid" => $this->nullable($this->tinyInteger()),
        ];
    }

    protected function bind(): void
    {
        $this->page    = isset($this->input["page"]) ? intval($this->input["page"]) : 1;
        $this->name    = isset($this->input["name"]) ? strval($this->input["name"]) : null;
        $this->isValid = isset($this->input["is_valid"]) ? intval($this->input["is_valid"]) : null;
    }
    
    protected function afterBinding(): void
    {
    }
}
