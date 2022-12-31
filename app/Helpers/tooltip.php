<?php

if (!function_exists('tooltip')) {
    function tooltip(string $place)
    {
        return view("tooltip." . $place);
    }
}