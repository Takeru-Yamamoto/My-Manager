<?php

use App\Consts\GateConst;
use App\Consts\ContentConst;
use App\Consts\ApplicationConst;

if (!function_exists('role')) {
    function role(): string
    {
        $role = authUserRole();

        if ($role === GateConst::SYSTEM_NUMBER) return GateConst::SYSTEM;
        if ($role > GateConst::SYSTEM_NUMBER && $role <= GateConst::ADMIN_NUMBER) return GateConst::ADMIN;
        if ($role > GateConst::ADMIN_NUMBER && $role <= GateConst::USER_NUMBER) return GateConst::USER;
    }
}

if (!function_exists('roleNum')) {
    function roleNum(): int
    {
        $role = authUserRole();

        if ($role === GateConst::SYSTEM_NUMBER) return GateConst::SYSTEM_NUMBER;
        if ($role > GateConst::SYSTEM_NUMBER && $role <= GateConst::ADMIN_NUMBER) return GateConst::ADMIN_NUMBER;
        if ($role > GateConst::ADMIN_NUMBER && $role <= GateConst::USER_NUMBER) return GateConst::USER_NUMBER;
    }
}

if (!function_exists('siteName')) {
    function siteName(): string
    {
        return ApplicationConst::SITE_NAME;
    }
}

if (!function_exists('isIconView')) {
    function isIconView(): bool
    {
        return ApplicationConst::IS_ICON_VIEW;
    }
}

if (!function_exists('assetIcon')) {
    function assetIcon(): string
    {
        return asset(ApplicationConst::ICON_DIRECTORY);
    }
}

if (!function_exists('urlSegment')) {
    function urlSegment(): string
    {
        $path = request()->path();

        if (strpos($path, "/") === false) return $path;

        $path = explode("/", $path);

        return current($path);
    }
}

if (!function_exists('contentHeader')) {
    function contentHeader(): string
    {
        return isset(ContentConst::TITLES[urlSegment()]) ? ContentConst::TITLES[urlSegment()] : "";
    }
}

if (!function_exists('pageTitle')) {
    function pageTitle(): string
    {
        $contentHeader = contentHeader();

        if (empty($contentHeader)) return siteName();

        return $contentHeader . ' | ' . siteName();
    }
}

if (!function_exists('pageFooter')) {
    function pageFooter(): string
    {
        $year = dateUtil()->year();

        if ($year === ApplicationConst::FIRST_PUBLICATION_YEAR) return "© " . $year . " " . ApplicationConst::COPYRIGHT_HOLDER_NAME;

        return "© " . ApplicationConst::FIRST_PUBLICATION_YEAR . " - " . $year . " " . ApplicationConst::COPYRIGHT_HOLDER_NAME;
    }
}
