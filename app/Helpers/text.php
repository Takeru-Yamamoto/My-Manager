<?php

use Illuminate\Support\Str;

if (!function_exists('configText')) {
    function configText(?string $textKey): string
    {
        return is_null($textKey) ? config("text.key_null") : config("text." . $textKey, "設定されたテキストが存在しません。 textKey: " . $textKey);
    }
}
if (!function_exists('enl2br')) {
    function enl2br(string $text): string
    {
        return nl2br(e($text));
    }
}
if (!function_exists('br2nl')) {
    function br2nl(string $text): string
    {
        return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $text);
    }
}
if (!function_exists('removeFromEnd')) {
    function removeFromEnd(string $text, int $num): string
    {
        return mb_substr($text, 0, (-1 * $num));
    }
}
if (!function_exists('zeroPadding')) {
    function zeroPadding(int $digit, int $num): string
    {
        return sprintf('%0' . $digit . 'd', $num);
    }
}
if (!function_exists('removeSpace')) {
    function removeSpace(string $text): string
    {
        return str_replace([" ", "　"], "", $text);
    }
}
if (!function_exists('removeDoubleBiteSpace')) {
    function removeDoubleBiteSpace(string $text): string
    {
        return str_replace("　", "", $text);
    }
}
if (!function_exists('convertToHarfSpace')) {
    function convertToHarfSpace(string $text): string
    {
        return str_replace("　", " ", $text);
    }
}
if (!function_exists('convertHarfWidthNumeric')) {
    function convertHarfWidthNumeric(string $text): string
    {
        return mb_convert_kana($text, "n");
    }
}
if (!function_exists('toKebab')) {
    function toKebab(string $text): string
    {
        return Str::kebab($text);
    }
}
if (!function_exists('toSnake')) {
    function toSnake(string $text): string
    {
        return Str::snake($text);
    }
}
if (!function_exists('toCamel')) {
    function toCamel(string $text): string
    {
        return Str::camel($text);
    }
}
if (!function_exists('toPascal')) {
    function toPascal(string $text): string
    {
        return Str::studly($text);
    }
}
if (!function_exists('toPlural')) {
    function toPlural(string $text): string
    {
        return Str::plural($text);
    }
}
if (!function_exists('toSingular')) {
    function toSingular(string $text): string
    {
        return Str::singular($text);
    }
}
if (!function_exists('toSlug')) {
    function toSlug(string $text): string
    {
        return Str::slug($text);
    }
}
if (!function_exists('isHiragana')) {
    function isHiragana(string $text): bool
    {
        return preg_match('/[^ぁ-んー]/u', $text);
    }
}
if (!function_exists('isKatakana')) {
    function isKatakana(string $text): bool
    {
        return preg_match('/[^ァ-ヶー]/u', $text);
    }
}
if (!function_exists('isKanji')) {
    function isKanji(string $text): bool
    {
        return preg_match('/[^一-龠]/u', $text);
    }
}
if (!function_exists('isAlphabet')) {
    function isAlphabet(string $text): bool
    {
        return preg_match('/[^a-zA-Z]/u', $text);
    }
}
if (!function_exists('isAlphabetUppercase')) {
    function isAlphabetUppercase(string $text): bool
    {
        return preg_match('/[^A-Z]/u', $text);
    }
}
if (!function_exists('isAlphabetLowercase')) {
    function isAlphabetLowercase(string $text): bool
    {
        return preg_match('/[^a-z]/u', $text);
    }
}
if (!function_exists('isAlphabetDoubleBite')) {
    function isAlphabetDoubleBite(string $text): bool
    {
        return preg_match('/[^ａ-ｚＡ-Ｚ]/u', $text);
    }
}
if (!function_exists('isAlphabetUppercaseDoubleBite')) {
    function isAlphabetUppercaseDoubleBite(string $text): bool
    {
        return preg_match('/[^Ａ-Ｚ]/u', $text);
    }
}
if (!function_exists('isAlphabetLowercaseDoubleBite')) {
    function isAlphabetLowercaseDoubleBite(string $text): bool
    {
        return preg_match('/[^ａ-ｚ]/u', $text);
    }
}
