<?php

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