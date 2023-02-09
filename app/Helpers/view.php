<?php

use App\Consts\ContentConst;

if (!function_exists('tooltip')) {
    function tooltip(string $place)
    {
        return view("tooltip." . $place);
    }
}
if (!function_exists('createCardHeader')) {
    function createCardHeader(): string
    {
        return contentHeader(type: "登録");
    }
}
if (!function_exists('updateCardHeader')) {
    function updateCardHeader(): string
    {
        return contentHeader(type: "編集");
    }
}
if (!function_exists('tableCardHeader')) {
    function tableCardHeader(): string
    {
        return contentHeader(type: ContentConst::IS_TABLE);
    }
}
if (!function_exists('formId')) {
    function formId(?int $num = null): string
    {
        return str_replace("/", "-", request()->path()) . "-form" . $num;
    }
}
if (!function_exists('isChecked')) {
    function isChecked(bool $bool): string
    {
        return $bool ? "checked" : "";
    }
}
if (!function_exists('isSelected')) {
    function isSelected(bool $bool): string
    {
        return $bool ? "selected" : "";
    }
}
