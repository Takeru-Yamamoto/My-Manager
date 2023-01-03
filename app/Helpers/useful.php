<?php
use Illuminate\Http\JsonResponse;


if (!function_exists('removeNullAndEmptyFromArray')) {
    function removeNullAndEmptyFromArray(array $array): array
    {
        $tmp = [];
        foreach($array as $item) {
            if( is_array($item) ) {
                $tmp[] = removeNullAndEmptyFromArray($item);
            } else if( ! empty($item) || $item === '0' || $item === 0 ) {
                $tmp[] = $item;
            }
        }
        return $tmp;
    }
}

if (!function_exists('convertToObjectFromSerializeArray')) {
    function convertToObjectFromSerializeArray(array $serializeArray): \stdClass
    {
        $data = new \stdClass();

        foreach ($serializeArray as $element) {
            $name = $element["name"];

            if (isset($data->$name)) {
                if (is_array($data->$name)) {
                    $data->$name[] = $element["value"];
                } else {
                    $array = array(
                        $data->$name,
                        $element["value"]
                    );
                    $data->$name = $array;
                }
            } else {
                $data->$name = $element["value"];
            }
        }

        return $data;
    }
}

if (!function_exists('expirationDate')) {
    function expirationDate(int $minute): string
    {
        return dateUtil()->addMinute($minute)->toDateTimeString();
    }
}

if (!function_exists('className')) {
    function className(object $object): string
    {
        return str_replace(__NAMESPACE__ . '\\', '', get_class($object));
    }
}

if (!function_exists('formId')) {
    function formId(?int $num = null): string
    {
        return str_replace("/", "-", request()->path()) . "-form" . $num;
    }
}

if (!function_exists('calendar')) {
    function calendar(string $formUrl, string $formUrlType, string $fetchUrl, string $fetchUrlType): string
    {
        return "<div id='calendar' data-form-url='" . $formUrl . "' data-form-url-type='" . $formUrlType . "' data-fetch-url='" . $fetchUrl . "' data-fetch-url-type='" . $fetchUrlType . "'></div>";
    }
}

if (!function_exists('border')) {
    function border(int $margin = 3): string
    {
        return "<div class='border my-" . $margin . "'></div>";
    }
}

if (!function_exists('responseJson')) {
    function responseJson(mixed $data = []): JsonResponse
    {
        return response()->json($data);
    }
}
