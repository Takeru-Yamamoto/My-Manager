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
            'value'      => required(),
            'model'      => required(validationString()),
            'eloquent'   => required(validationString()),
            'from'       => required(validationString()),
            'to'         => required(validationString()),
            'limit'      => required(validationInteger()),
            'additional' => nullable(validationJson()),
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
