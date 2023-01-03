<?php

use App\Consts\GateConst;
use App\Consts\ContentConst;
use App\Consts\ApplicationConst;
use App\Consts\NameConst;

if (!function_exists('role')) {
    function role(): string
    {
        $role = authUserRole();

        if ($role === GateConst::SYSTEM_NUMBER) {
            return GateConst::SYSTEM;
        } elseif ($role > GateConst::SYSTEM_NUMBER && $role <= GateConst::ADMIN_NUMBER) {
            return GateConst::ADMIN;
        } elseif ($role > GateConst::ADMIN_NUMBER && $role <= GateConst::USER_NUMBER) {
            return GateConst::USER;
        }
    }
}

if (!function_exists('roleNum')) {
    function roleNum(): int
    {
        $role = authUserRole();

        if ($role === GateConst::SYSTEM_NUMBER) {
            return GateConst::SYSTEM_NUMBER;
        } elseif ($role > GateConst::SYSTEM_NUMBER && $role <= GateConst::ADMIN_NUMBER) {
            return GateConst::ADMIN_NUMBER;
        } elseif ($role > GateConst::ADMIN_NUMBER && $role <= GateConst::USER_NUMBER) {
            return GateConst::USER_NUMBER;
        }
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
        if (strpos($path, "/") === false) {
            return $path;
        } else {
            $path = explode("/", $path);
            return $path[0];
        }
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
        if (empty($contentHeader)) {
            return siteName();
        } else {
            return $contentHeader . ' | ' . siteName();
        }
    }
}

if (!function_exists('pageFooter')) {
    function pageFooter(): string
    {
        $year = dateUtil()->year();
        if ($year === ApplicationConst::FIRST_PUBLICATION_YEAR) {
            return "© " . $year . " " . ApplicationConst::COPYRIGHT_HOLDER_NAME;
        } else {
            return "© " . ApplicationConst::FIRST_PUBLICATION_YEAR . " - " . $year . " " . ApplicationConst::COPYRIGHT_HOLDER_NAME;
        }
    }
}

if (!function_exists('cardHeader')) {
    function cardHeader(?string $kind = null): string
    {
        $cardHeader = ContentConst::TITLES[urlSegment()];
        if (isset(NameConst::NAMES[NameConst::TYPE_SHORT][$kind])) {
            return $cardHeader . NameConst::NAMES[NameConst::TYPE_SHORT][$kind];
        }

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
