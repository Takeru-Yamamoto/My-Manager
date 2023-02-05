<?php

use App\Consts\GateConst;
use App\Consts\ContentConst;
use App\Models\User;

if (!function_exists('role')) {
    function role(User $user = null): string
    {
        if (!isLoggedIn()) return GateConst::GUEST;
        $role = is_null($user) ? authUserRole() : $user->role;
        if ($role === GateConst::SYSTEM_NUMBER) return GateConst::SYSTEM;
        if ($role > GateConst::SYSTEM_NUMBER && $role <= GateConst::ADMIN_NUMBER) return GateConst::ADMIN;
        if ($role > GateConst::ADMIN_NUMBER && $role <= GateConst::USER_NUMBER) return GateConst::USER;
    }
}
if (!function_exists('roleNum')) {
    function roleNum(User $user = null): int
    {
        if (!isLoggedIn()) return GateConst::GUEST_NUMBER;
        $role = is_null($user) ? authUserRole() : $user->role;
        if ($role === GateConst::SYSTEM_NUMBER) return GateConst::SYSTEM_NUMBER;
        if ($role > GateConst::SYSTEM_NUMBER && $role <= GateConst::ADMIN_NUMBER) return GateConst::ADMIN_NUMBER;
        if ($role > GateConst::ADMIN_NUMBER && $role <= GateConst::USER_NUMBER) return GateConst::USER_NUMBER;
    }
}
if (!function_exists('urlSegment')) {
    function urlSegment(): string
    {
        $path = explode("/", request()->path());
        return current($path);
    }
}
if (!function_exists('contentHeader')) {
    function contentHeader(string $content = null): string
    {
        if (is_null($content)) $content = urlSegment();
        return isset(ContentConst::TITLES[$content]) ? ContentConst::TITLES[$content] . ContentConst::IS_TITLE : "";
    }
}
if (!function_exists('pageTitle')) {
    function pageTitle(): string
    {
        $contentHeader = contentHeader();
        return empty($contentHeader) ? config("application.site_name") : $contentHeader . ' | ' . config("application.site_name");
    }
}
if (!function_exists('pageFooter')) {
    function pageFooter(): string
    {
        $year = dateUtil()->year();
        return $year === config("application.first_publication_year") ? "© " . $year . " " . config("application.copyright_holder_name") : "© " . config("application.first_publication_year") . " - " . $year . " " . config("application.copyright_holder_name");
    }
}
