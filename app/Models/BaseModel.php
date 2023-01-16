<?php

namespace App\Models;

trait BaseModel
{
    public function isValid(): bool
    {
        return isset($this->is_valid) ? $this->is_valid : false;
    }

    public function safeSave(string $message): void
    {
        Transaction($message, function () {
            $this->save();
        });
    }

    public function safeDelete(string $message): void
    {
        Transaction($message, function () {
            $this->delete();
        });
    }

    public function changeIsValid(string $message, int $isValid): void
    {
        if (isset($this->is_valid)) {
            $this->is_valid = $isValid;
            $this->safeSave($message);
        }
    }
}
