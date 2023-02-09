<?php

use App\Consts\ContentConst;

if (!function_exists('urlSegment')) {
    function urlSegment(): string
    {
        $path = explode("/", request()->path());
        return current($path);
    }
}
if (!function_exists('contentHeader')) {
    function contentHeader(string $content = null, string $type = null): string
    {
        if (is_null($content)) $content = urlSegment();
        if (is_null($type)) $type = ContentConst::IS_TITLE;
        return isset(ContentConst::PAGES[$content]) && isset(ContentConst::PAGES[$content]["title"]) ? ContentConst::PAGES[$content]["title"] . $type : "";
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
