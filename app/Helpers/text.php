<?php

use App\Consts\TextConst;

if (!function_exists('getTextFromConst')) {
    function getTextFromConst(?string $textKey): string
    {
        if (is_null($textKey)) {
            return TextConst::TEXTS[TextConst::KEY_NULL];
        }

        if (!isset(TextConst::TEXTS[$textKey])) {
            return TextConst::TEXTS[TextConst::KEY_NOT_EXIST];
        }

        return TextConst::TEXTS[$textKey];
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
        return substr($text, 0, (-1 * $num));
    }
}

if (!function_exists('zeroPadding')) {
    function zeroPadding(int $digit, int $num): string
    {
        return sprintf('%0' . $digit . 'd', $num);
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
