<?php

if (!function_exists('convertToCalendarEvent')) {
    function convertToCalendarEvent(int $id, string $title, string $start, string $end, ?string $description = null, ?string $color = null, ?string $url = null): array
    {
        $event = [
            "id"    => $id,
            "title" => $title,
            "start" => $start,
            "end"   => $end,
        ];

        if (!is_null($description)) $event["description"] = nl2br($description);
        if (!is_null($color)) $event["color"]             = $color;
        if (!is_null($url)) $event["url"]                 = $url;

        return $event;
    }
}
