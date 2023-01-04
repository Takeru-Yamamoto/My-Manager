<?php

namespace App\Http\Forms;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\InvalidFormException;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

abstract class BaseForm
{
    public $errors = [];

    public function __construct(array $input)
    {
        $this->validate($input);

        if (!$this->hasError()) {
            $this->bind($input);

            $this->validateAfterBinding();
        }
    }

    abstract protected function bind(array $input): void;
    abstract protected function validationRule(): array;
    abstract protected function validateAfterBinding(): void;


    protected function validate(array $input): void
    {
        $validation = Validator::make($input, $this->validationRule());

        if ($validation->fails()) {
            $messages = $validation->errors()->getMessages();

            foreach ($messages as $message) {
                foreach ($message as $row) {
                    $this->errors[] = $row;
                }
            }
        }
    }


    public function hasError(): bool
    {
        return !empty($this->errors);
    }

    public function addError(string $errorText): void
    {
        $this->errors[] = $errorText;
    }

    public function redirect(string $path): Redirector|RedirectResponse
    {
        return redirect($path)->with('danger_message', $this->errors)->withInput();
    }

    public function exception(string $errorText = null): InvalidFormException
    {
        if (!is_null($errorText)) $this->addError($errorText);
        return new InvalidFormException($this);
    }
}
