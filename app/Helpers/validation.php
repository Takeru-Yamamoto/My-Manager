<?php

if (!function_exists("required")) {
    function required(array $rules = []): array
    {
        array_unshift($rules, "required");

        return $rules;
    }
}

if (!function_exists("nullable")) {
    function nullable(array $rules = []): array
    {
        array_unshift($rules, "nullable");

        return $rules;
    }
}


/* unique */
if (!function_exists("validationId")) {
    function validationId(string $tableName): array
    {
        return ["string", "exists:" . $tableName . ",id"];
    }
}

if (!function_exists("validationUserId")) {
    function validationUserId(): array
    {
        return validationId("users");
    }
}

if (!function_exists("validationEmail")) {
    function validationEmail(): array
    {
        return ["string", "email", "max:255"];
    }
}

if (!function_exists("validationTel")) {
    function validationTel(): array
    {
        return ["string", "regex:/^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/"];
    }
}

if (!function_exists("validationPassword")) {
    function validationPassword(): array
    {
        return ["string", "min:8", "max:32"];
    }
}

if (!function_exists("validationPasswordConfirmed")) {
    function validationPasswordConfirmed(): array
    {
        return ["string", "min:8", "max:32", "confirmed"];
    }
}

if (!function_exists("validationPostCode")) {
    function validationPostCode(): array
    {
        return ["string", "regex:/^[0-9]{3}-[0-9]{4}$/"];
    }
}

if (!function_exists("validationCode")) {
    function validationCode(mixed $digit): array
    {
        return ["string", "regex:/^[0-9]{" . $digit . "}$/"];
    }
}


/* string */
if (!function_exists("validationString")) {
    function validationString(): array
    {
        return ["string", "max:255"];
    }
}

if (!function_exists("validationLongText")) {
    function validationLongText(): array
    {
        return ["string"];
    }
}


/* integer */
if (!function_exists("validationInteger")) {
    function validationInteger(): array
    {
        return ["integer"];
    }
}

if (!function_exists("validationTinyInteger")) {
    function validationTinyInteger(): array
    {
        return ["integer", "in:0,1"];
    }
}


/* boolean */
if (!function_exists("validationBoolean")) {
    function validationBoolean(): array
    {
        return ["boolean"];
    }
}


/* array */
if (!function_exists("validationJson")) {
    function validationJson(): array
    {
        return ["array"];
    }
}


/* datetime */
if (!function_exists("validationDate")) {
    function validationDate(): array
    {
        return ["string", "regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/"];
    }
}

if (!function_exists("validationTime")) {
    function validationTime(): array
    {
        return ["string", "regex:/^([0-9]{2}:[0-9]{2}|[0-9]{2}:[0-9]{2}:[0-9]{2})$/"];
    }
}

if (!function_exists("validationMonth")) {
    function validationMonth(): array
    {
        return ["string", "regex:/^[0-9]{4}-[0-9]{2}$/"];
    }
}
