<?php

namespace App\Http\Forms;

use Illuminate\Support\Facades\Validator as Validation;
use Illuminate\Validation\Validator;

abstract class BaseForm extends ValidationRule
{
    protected Validator $validator;
    protected array $input;

    public function __construct(array $input)
    {
        $this->input = $input;

        $this->prepareForValidation();

        $this->validator = Validation::make($input, $this->validationRule());

        if ($this->validator->fails()) $this->validator->validate();

        $this->input = $this->validator->validated();

        $this->bind();

        $this->afterBinding();
    }

    abstract protected function prepareForValidation(): void;
    abstract protected function bind(): void;
    abstract protected function validationRule(): array;
    abstract protected function afterBinding(): void;
}
