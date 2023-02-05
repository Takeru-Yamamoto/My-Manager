<?php

use App\Consts\ContentConst;

if (!function_exists('tooltip')) {
    function tooltip(string $place)
    {
        return view("tooltip." . $place);
    }
}
if (!function_exists('cardHeader')) {
    function cardHeader(string $type): string
    {
        return ContentConst::TITLES[urlSegment()] . $type;
    }
}
if (!function_exists('createCardHeader')) {
    function createCardHeader(): string
    {
        return cardHeader("登録");
    }
}
if (!function_exists('updateCardHeader')) {
    function updateCardHeader(): string
    {
        return cardHeader("編集");
    }
}
if (!function_exists('tableCardHeader')) {
    function tableCardHeader(): string
    {
        return cardHeader(ContentConst::IS_TABLE);
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
