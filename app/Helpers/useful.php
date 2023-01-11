<?php

use Illuminate\Http\JsonResponse;
use App\Consts\ContentConst;

if (!function_exists('varDump')) {
    function varDump(mixed $any): void
    {
        echo "<pre>";
        var_dump($any);
        echo "</pre>";
    }
}

if (!function_exists('arraySearchKey')) {
    function arraySearchKey(array $haystack, mixed $column, mixed $needle): mixed
    {
        return array_search($needle, array_column($haystack, $column));
    }
}

if (!function_exists('arraySearchValue')) {
    function arraySearchValue(array $haystack, mixed $column, mixed $needle): mixed
    {
        $key = arraySearchKey($haystack, $column, $needle);

        return isset($haystack[$key]) ? $haystack[$key] : null;
    }
}

if (!function_exists('className')) {
    function className(object $object): string
    {
        return str_replace(__NAMESPACE__ . '\\', '', get_class($object));
    }
}

if (!function_exists('responseJson')) {
    function responseJson(mixed $data = []): JsonResponse
    {
        return response()->json($data);
    }
}

if (!function_exists('convertToBootstrapColorCode')) {
    function convertToBootstrapColorCode(string $class): string|null
    {
        if (isset(ContentConst::BOOTSTRAP_CLASS_COLORS[$class])) $class = ContentConst::BOOTSTRAP_CLASS_COLORS[$class];

        return isset(ContentConst::BOOTSTRAP_COLOR_CODES[$class]) ? ContentConst::BOOTSTRAP_COLOR_CODES[$class] : null;
    }
}

if (!function_exists('removeNullAndEmptyFromArray')) {
    function removeNullAndEmptyFromArray(array $array): array
    {
        $tmp = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $tmp[] = removeNullAndEmptyFromArray($item);
            } else if (!empty($item) || $item === '0' || $item === 0) {
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