<?php

return [
    "time"       => env("ACCESS_TIME", false),
    "path"       => env("ACCESS_PATH", false),
    "method"     => env("ACCESS_METHOD", false),
    "user_agent" => env("ACCESS_USER_AGENT", false),
    "ip"         => env("ACCESS_IP", false),
    "memory"     => env("ACCESS_MEMORY", false),
    "event"      => env("ACCESS_EVENT", false),
];
