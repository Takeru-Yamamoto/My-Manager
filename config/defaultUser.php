<?php

return [
    "system" => [
        'name'     => env('SYSTEM_NAME'),
        'email'    => env('SYSTEM_EMAIL'),
        'password' => env('SYSTEM_PASSWORD'),
    ],
    "admin" => [
        'name'     => env('ADMIN_NAME'),
        'email'    => env('ADMIN_EMAIL'),
        'password' => env('ADMIN_PASSWORD'),
    ],
    "user" => [
        'name'     => env('USER_NAME'),
        'email'    => env('USER_EMAIL'),
        'password' => env('USER_PASSWORD'),
    ],
];
