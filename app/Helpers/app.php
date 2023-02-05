<?php

use App\Consts\RoleConst;
use App\Consts\ContentConst;
use App\Models\User;

if (!function_exists('role')) {
    function role(User $user = null): string
    {
        if (!isLoggedIn()) return RoleConst::GUEST;
        $role = is_null($user) ? authUserRole() : $user->role;
        if ($role === RoleConst::SYSTEM_NUMBER) return RoleConst::SYSTEM;
        if ($role > RoleConst::SYSTEM_NUMBER && $role <= RoleConst::ADMIN_NUMBER) return RoleConst::ADMIN;
        if ($role > RoleConst::ADMIN_NUMBER && $role <= RoleConst::USER_NUMBER) return RoleConst::USER;
    }
}
if (!function_exists('roleNum')) {
    function roleNum(User $user = null): int
    {
        if (!isLoggedIn()) return RoleConst::GUEST_NUMBER;
        $role = is_null($user) ? authUserRole() : $user->role;
        if ($role === RoleConst::SYSTEM_NUMBER) return RoleConst::SYSTEM_NUMBER;
        if ($role > RoleConst::SYSTEM_NUMBER && $role <= RoleConst::ADMIN_NUMBER) return RoleConst::ADMIN_NUMBER;
        if ($role > RoleConst::ADMIN_NUMBER && $role <= RoleConst::USER_NUMBER) return RoleConst::USER_NUMBER;
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
