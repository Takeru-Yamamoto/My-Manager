<?php

if (!function_exists('calendar')) {
    function calendar(string $createFormUrl, string $createFormUrlType, string $updateFormUrl, string $updateFormUrlType, string $fetchUrl, string $fetchUrlType): string
    {
        $html = "";
        $html .= "<div id='calendar'";
        $html .= " data-create-form-url='" . $createFormUrl . "'";
        $html .= " data-create-form-url-type='" . $createFormUrlType . "'";
        $html .= " data-update-form-url='" . $updateFormUrl . "'";
        $html .= " data-update-form-url-type='" . $updateFormUrlType . "'";
        $html .= " data-fetch-url='" . $fetchUrl . "'";
        $html .= " data-fetch-url-type='" . $fetchUrlType . "'";
        $html .= "></div>";

        return $html;
    }
}

if (!function_exists('convertToCalendarEvent')) {
    function convertToCalendarEvent(int $id, string $title, string $start, string $end, ?string $description = null, ?string $url = null, ?string $color = null): array
    {
        $event = [
            "id"    => $id,
            "title" => $title,
            "start" => $start,
            "end"   => $end,
        ];

        if (!is_null($description)) $event["description"] = nl2br($description);
        if (!is_null($url)) $event["url"]                 = $url;
        if (!is_null($color)) $event["color"]             = $color;

        return $event;
    }
}
