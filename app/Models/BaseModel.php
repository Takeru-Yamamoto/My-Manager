<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

trait BaseModel
{
    public function isValid(): bool
    {
        assert($this instanceof Model);
        return isset($this->is_valid) ? $this->is_valid : false;
    }

    public function safeSave(string $message): void
    {
        assert($this instanceof Model);
        Transaction($message, function () {
            $this->save();
        });
    }

    public function safeDelete(string $message): void
    {
        assert($this instanceof Model);
        Transaction($message, function () {
            $this->delete();
        });
    }

    public function changeIsValid(string $message, int $isValid): void
    {
        assert($this instanceof Model);
        if (isset($this->is_valid)) {
            $this->is_valid = $isValid;
            $this->safeSave($message);
        }
    }
}
