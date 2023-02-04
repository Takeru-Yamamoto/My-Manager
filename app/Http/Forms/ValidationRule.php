<?php

namespace App\Http\Forms;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

abstract class ValidationRule
{
    /* 
        field: 必須
        input: 空でない
    */
    protected function required(array ...$rules): array
    {
        return arrayMergeUnique(["required"], multiDimensionsArrayMergeUnique($rules));
    }

    /* 
        field: 不要
        input: 空でもよい
    */
    protected function nullable(array $rules = []): array
    {
        return arrayMergeUnique(["nullable"], multiDimensionsArrayMergeUnique($rules));
    }

    /* 
        field: 不要
        input: fieldあり => 空でない, fieldなし => 空でもよい
    */
    protected function filled(array $rules = []): array
    {
        return arrayMergeUnique(["filled"], multiDimensionsArrayMergeUnique($rules));
    }

    /* 
        field: 必須
        input: 空でもよい
    */
    protected function present(array $rules = []): array
    {
        return arrayMergeUnique(["present"], multiDimensionsArrayMergeUnique($rules));
    }


    // useful
    protected function id(string $tableName): array
    {
        return ["integer", "exists:" . $tableName . ",id"];
    }
    protected function userId(): array
    {
        return $this->id("users");
    }
    protected function email(): array
    {
        return ["string", "email", "max:255"];
    }
    protected function tel(): array
    {
        return ["string", "regex:/^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/"];
    }
    protected function password(): array
    {
        return ["string", "min:8", "max:32"];
    }
    protected function passwordConfirmed(): array
    {
        return ["string", "min:8", "max:32", "confirmed"];
    }
    protected function postCode(): array
    {
        return ["string", "regex:/^[0-9]{3}-[0-9]{4}$/"];
    }
    protected function code(mixed $digit): array
    {
        return ["string", "regex:/^[0-9]{" . $digit . "}$/"];
    }


    /* string */
    protected function string(): array
    {
        return ["string", "max:255"];
    }
    protected function longtext(): array
    {
        return ["string"];
    }
    protected function lowercase(): array
    {
        return ["lowercase"];
    }
    protected function uppercase(): array
    {
        return ["uppercase"];
    }
    protected function json(): array
    {
        return ["json"];
    }
    protected function alpha(): array
    {
        return ["regex:/^[a-zA-Z]+$/"];
    }
    protected function alphaNum(): array
    {
        return ["regex:/^[a-zA-Z0-9]+$/"];
    }
    protected function alphaDash(): array
    {
        return ["regex:/^[a-zA-Z0-9\-_]+$/"];
    }
    protected function ip(): array
    {
        return ["ip"];
    }
    protected function ipv4(): array
    {
        return ["ipv4"];
    }
    protected function ipv6(): array
    {
        return ["ipv6"];
    }

    /* int */
    protected function integer(): array
    {
        return ["integer"];
    }
    protected function numeric(): array
    {
        return ["numeric"];
    }
    protected function tinyInteger(): array
    {
        return ["integer", "in:0,1"];
    }
    protected function decimal(int $min, int $max = null): array
    {
        return is_null($max) ? ["decimal:" . $min] : ["decimal:" . $min . "," . $max];
    }
    protected function digits(int $min, int $max = null): array
    {
        return is_null($max) ? ["digits:" . $min] : ["digits_between:" . $min . "," . $max];
    }

    /* bool */
    protected function boolean(): array
    {
        return ["boolean"];
    }

    /* array */
    protected function array(array $acceptKeys = []): array
    {
        return empty($acceptKeys) ? ["array"] : ["array:" . implode(",", $acceptKeys)];
    }
    protected function size(int $size): array
    {
        return ["size:" . $size];
    }

    /* datetime */
    protected function date(): array
    {
        return ["date_format:Y-m-d"];
    }
    protected function time(): array
    {
        return ["regex:/^([0-9]{2}:[0-9]{2}|[0-9]{2}:[0-9]{2}:[0-9]{2})$/"];
    }
    protected function datetime(): array
    {
        return ["date_format:Y-m-d H:i:s"];
    }
    protected function month(): array
    {
        return ["date_format:Y-m"];
    }
    protected function after(string $dateOrField): array
    {
        return ["after:" . $dateOrField];
    }
    protected function before(string $dateOrField): array
    {
        return ["before:" . $dateOrField];
    }

    /* file */
    protected function file(): array
    {
        return ["file"];
    }
    protected function image(): array
    {
        return ["image"];
    }
    protected function mimes(array $mimes): array
    {
        return ["mimes:" . implode(",", $mimes)];
    }
    protected function mimetypes(array $mimetypes): array
    {
        return ["mimetypes:" . implode(",", $mimetypes)];
    }
    protected function dimensions(): Rules\Dimensions
    {
        return Rule::dimensions();
    }

    /* other */
    protected function requiredIf(string $field, array $values): array
    {
        return ["required_if:" . $field . "," . implode(",", $values)];
    }
    protected function requiredUnless(string $field, array $values): array
    {
        return ["required_unless:" . $field . "," . implode(",", $values)];
    }
    protected function requiredWith(array $fields): array
    {
        return ["required_with:" . implode(",", $fields)];
    }
    protected function requiredWithAll(array $fields): array
    {
        return ["required_with_all:" . implode(",", $fields)];
    }
    protected function requiredWithout(array $fields): array
    {
        return ["required_without:" . implode(",", $fields)];
    }
    protected function requiredWithoutAll(array $fields): array
    {
        return ["required_without_all:" . implode(",", $fields)];
    }
    protected function exists(string $table, string $column = null): Rules\Exists
    {
        return Rule::exists($table, $column)->whereNull("deleted_at");
    }
    protected function unique(string $table, string $column = null): Rules\Unique
    {
        return Rule::unique($table, $column)->whereNull("deleted_at");
    }

    protected function regex(string $regex): array
    {
        return ["regex:" . $regex];
    }
    protected function notRegex(string $regex): array
    {
        return ["not_regex:" . $regex];
    }

    protected function max(string $num): array
    {
        return ["max:" . $num];
    }
    protected function min(string $num): array
    {
        return ["min:" . $num];
    }

    protected function gt(string $field): array
    {
        return ["gt:" . $field];
    }
    protected function gte(string $field): array
    {
        return ["gte:" . $field];
    }
    protected function lt(string $field): array
    {
        return ["lt:" . $field];
    }
    protected function lte(string $field): array
    {
        return ["lte:" . $field];
    }

    protected function accepted(): array
    {
        return ["accepted"];
    }
    protected function declined(): array
    {
        return ["declined"];
    }

    protected function between(int $min, int $max): array
    {
        return ["between:" . $min . "," . $max];
    }
    protected function in(array $values): Rules\In
    {
        return Rule::in($values);
    }
    protected function notIn(array $values): Rules\NotIn
    {
        return Rule::notIn($values);
    }

    protected function confirmed(): array
    {
        return ["confirmed"];
    }
    protected function different(string $field): array
    {
        return ["different:" . $field];
    }
}
