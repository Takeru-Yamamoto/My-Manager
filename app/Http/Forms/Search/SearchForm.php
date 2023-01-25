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

    protected function validationRule(): array
    {
        return [
            'value'      => $this->required(),
            'model'      => $this->required($this->string()),
            'eloquent'   => $this->required($this->string()),
            'from'       => $this->required($this->string()),
            'to'         => $this->required($this->string()),
            'limit'      => $this->required($this->integer()),
            'additional' => $this->nullable($this->json()),
        ];
    }

    protected function bind(array $input): void
    {
        $this->value      = $input['value'];
        $this->model      = strval($input['model']);
        $this->eloquent   = strval($input['eloquent']);
        $this->from       = strval($input['from']);
        $this->to         = strval($input['to']);
        $this->limit      = intval($input['limit']);
        $this->additional = isset($input['additional']) ? $input['additional'] : null;
    }

    protected function validateAfterBinding(): void
    {
    }
}
