<?php

namespace App\Http\Forms;

abstract class ValidationRule
{
    public function required(array $rules = []): array
    {
        array_unshift($rules, "required");
        return $rules;
    }

    public function nullable(array $rules = []): array
    {
        array_unshift($rules, "nullable");
        return $rules;
    }


    // unique
    public function id(string $tableName): array
    {
        return ["string", "exists:" . $tableName . ",id"];
    }

    public function userId(): array
    {
        return $this->id("users");
    }

    public function email(): array
    {
        return ["string", "email", "max:255"];
    }

    public function tel(): array
    {
        return ["string", "regex:/^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/"];
    }

    public function password(): array
    {
        return ["string", "min:8", "max:32"];
    }

    public function passwordConfirmed(): array
    {
        return ["string", "min:8", "max:32", "confirmed"];
    }

    public function postCode(): array
    {
        return ["string", "regex:/^[0-9]{3}-[0-9]{4}$/"];
    }

    public function code(mixed $digit): array
    {
        return ["string", "regex:/^[0-9]{" . $digit . "}$/"];
    }


    // string
    public function string(): array
    {
        return ["string", "max:255"];
    }

    public function longtext(): array
    {
        return ["string"];
    }


    // integer
    public function integer(): array
    {
        return ["integer"];
    }

    public function tinyInteger(): array
    {
        return ["integer", "in:0,1"];
    }


    // boolean
    public function boolean(): array
    {
        return ["boolean"];
    }


    // boolean
    public function json(): array
    {
        return ["array"];
    }


    // datetime
    public function date(): array
    {
        return ["string", "regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/"];
    }

    public function time(): array
    {
        return ["string", "regex:/^([0-9]{2}:[0-9]{2}|[0-9]{2}:[0-9]{2}:[0-9]{2})$/"];
    }

    public function month(): array
    {
        return ["string", "regex:/^[0-9]{4}-[0-9]{2}$/"];
    }
}
