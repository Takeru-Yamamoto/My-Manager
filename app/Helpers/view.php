<?php

use App\Consts\ContentConst;
use App\Consts\NameConst;

if (!function_exists('cardHeader')) {
    function cardHeader(?string $kind = null): string
    {
        $cardHeader = ContentConst::TITLES[urlSegment()];

        if (isset(NameConst::NAMES[NameConst::TYPE_SHORT][$kind])) return $cardHeader . NameConst::NAMES[NameConst::TYPE_SHORT][$kind];

        return $cardHeader;
    }
}

if (!function_exists('createCardHeader')) {
    function createCardHeader(): string
    {
        return cardHeader(NameConst::CREATE);
    }
}

if (!function_exists('updateCardHeader')) {
    function updateCardHeader(): string
    {
        return cardHeader(NameConst::UPDATE);
    }
}

if (!function_exists('tableCardHeader')) {
    function tableCardHeader(): string
    {
        return cardHeader() . ContentConst::IS_TABLE;
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
