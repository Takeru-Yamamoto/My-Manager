<?php

namespace App\Http\Forms\Search;

use App\Http\Forms\BaseForm;

class SearchForm extends BaseForm
{
    public $value;
    public $model;
    public $eloquent;
    public $from;
    public $to;
    public $limit;
    public $additional;

    protected function prepareForValidation(): void
    {
    }

    protected function validationRule(): array
    {
        return [
            "value"      => $this->required(),
            "model"      => $this->required($this->string(), $this->in(["user", "emailReset", "passwordReset"])),
            "eloquent"   => $this->required($this->string(), $this->in(["where", "like"])),
            "from"       => $this->required($this->string()),
            "to"         => $this->required($this->string()),
            "limit"      => $this->required($this->integer()),
            "additional" => $this->nullable($this->array()),
        ];
    }

    protected function bind(): void
    {
        $this->value      = $this->input["value"];
        $this->model      = strval($this->input["model"]);
        $this->eloquent   = strval($this->input["eloquent"]);
        $this->from       = strval($this->input["from"]);
        $this->to         = strval($this->input["to"]);
        $this->limit      = intval($this->input["limit"]);
        $this->additional = isset($this->input["additional"]) ? $this->input["additional"] : null;
    }

    protected function afterBinding(): void
    {
    }
}
