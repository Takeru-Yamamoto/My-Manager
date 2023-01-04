<?php

use App\Consts\BtnConst;
use App\Consts\NameConst;

/* html */
if (!function_exists('btnDelete')) {
    function btnDelete(string $url, int $id, string $addClass = "", string $type = NameConst::TYPE_SHORT): string
    {
        $html = "";
        $html .= "<a class='" . btnDeleteClass() . " " . $addClass . "' data-url='" . $url . "' data-id='" . $id . "'>";
        $html .= btnDeleteText($type);
        $html .= "</a>";

        return $html;
    }
}

if (!function_exists('btnFlg')) {
    function btnFlg(string $url, int $id, bool $flg, string $addClass = "", string $type = NameConst::TYPE_SHORT): string
    {
        $new_flg = $flg ? 0 : 1;

        $html = "";
        $html .= "<a class='" . btnFlgClass($flg) . " " . $addClass . "' data-url='" . $url . "' data-id='" . $id . "' data-flg='" . $new_flg . "'>";
        $html .= btnFlgText($type, $flg);
        $html .= "</a>";

        return $html;
    }
}

if (!function_exists('btnModalAjax')) {
    function btnModalAjax(string $url, int $id, string $type, string $text = "モーダル表示", string $addClass = ""): string
    {
        $html = "";
        $html .= "<a class='" . btnModalAjaxClass() . " " . $addClass . "' data-url='" . $url . "' data-id='" . $id . "' data-type='" . $type . "'>";
        $html .= $text;
        $html .= "</a>";

        return $html;
    }
}


/* class */
if (!function_exists('btnClass')) {
    function btnClass(string $kind): string
    {
        return BtnConst::BTN_CLASS_MAP[$kind];
    }
}

if (!function_exists('btnCreateClass')) {
    function btnCreateClass(): string
    {
        return btnClass(NameConst::CREATE);
    }
}

if (!function_exists('btnUpdateClass')) {
    function btnUpdateClass(): string
    {
        return btnClass(NameConst::UPDATE);
    }
}

if (!function_exists('btnDeleteClass')) {
    function btnDeleteClass(): string
    {
        return btnClass(NameConst::DELETE);
    }
}

if (!function_exists('btnChangeClass')) {
    function btnChangeClass(): string
    {
        return btnClass(NameConst::CHANGE);
    }
}

if (!function_exists('btnFlgClass')) {
    function btnFlgClass(int $flg): string
    {
        if ($flg !== 0 && $flg !== 1) return "";
        return btnClass($flg);
    }
}

if (!function_exists('btnLinkClass')) {
    function btnLinkClass(): string
    {
        return btnClass(BtnConst::LINK);
    }
}

if (!function_exists('btnSpinnerClass')) {
    function btnSpinnerClass(): string
    {
        return btnClass(BtnConst::SPINNER);
    }
}

if (!function_exists('btnModalClass')) {
    function btnModalClass(): string
    {
        return btnClass(BtnConst::MODAL);
    }
}

if (!function_exists('btnModalAjaxClass')) {
    function btnModalAjaxClass(): string
    {
        return btnClass(BtnConst::MODAL_AJAX);
    }
}

if (!function_exists('btnFormSubmit')) {
    function btnFormSubmit(): string
    {
        return btnClass(BtnConst::FORM_SUBMIT);
    }
}

if (!function_exists('btnBlock')) {
    function btnBlock(): string
    {
        return btnClass(BtnConst::BLOCK);
    }
}

if (!function_exists('btnRight')) {
    function btnRight(): string
    {
        return btnClass(BtnConst::RIGHT);
    }
}


/* text */
if (!function_exists('btnText')) {
    function btnText(string $type, string $kind): string
    {
        if (!in_array($type, NameConst::TYPES)) return "";
        return NameConst::NAMES[$type][$kind];
    }
}

if (!function_exists('btnCreateText')) {
    function btnCreateText(string $type): string
    {
        return btnText($type, NameConst::CREATE);
    }
}

if (!function_exists('btnCreateFullText')) {
    function btnCreateFullText(): string
    {
        return btnCreateText(NameConst::TYPE_FULL);
    }
}

if (!function_exists('btnCreateShortText')) {
    function btnCreateShortText(): string
    {
        return btnCreateText(NameConst::TYPE_SHORT);
    }
}

if (!function_exists('btnUpdateText')) {
    function btnUpdateText(string $type): string
    {
        return btnText($type, NameConst::UPDATE);
    }
}

if (!function_exists('btnUpdateFullText')) {
    function btnUpdateFullText(): string
    {
        return btnUpdateText(NameConst::TYPE_FULL);
    }
}

if (!function_exists('btnUpdateShortText')) {
    function btnUpdateShortText(): string
    {
        return btnUpdateText(NameConst::TYPE_SHORT);
    }
}

if (!function_exists('btnDeleteText')) {
    function btnDeleteText(string $type): string
    {
        return btnText($type, NameConst::DELETE);
    }
}

if (!function_exists('btnDeleteFullText')) {
    function btnDeleteFullText(): string
    {
        return btnDeleteText(NameConst::TYPE_FULL);
    }
}

if (!function_exists('btnDeleteShortText')) {
    function btnDeleteShortText(): string
    {
        return btnDeleteText(NameConst::TYPE_SHORT);
    }
}

if (!function_exists('btnChangeText')) {
    function btnChangeText(string $type): string
    {
        return btnText($type, NameConst::CHANGE);
    }
}

if (!function_exists('btnChangeFullText')) {
    function btnChangeFullText(): string
    {
        return btnChangeText(NameConst::TYPE_FULL);
    }
}

if (!function_exists('btnChangeShortText')) {
    function btnChangeShortText(): string
    {
        return btnChangeText(NameConst::TYPE_SHORT);
    }
}

if (!function_exists('btnFlgText')) {
    function btnFlgText(string $type, int $flg): string
    {
        if ($flg !== 0 && $flg !== 1) return "";
        return btnText($type, $flg);
    }
}

if (!function_exists('btnFlgFullText')) {
    function btnFlgFullText(int $flg): string
    {
        return btnFlgText(NameConst::TYPE_FULL, $flg);
    }
}

if (!function_exists('btnFlgShortText')) {
    function btnFlgShortText(int $flg): string
    {
        return btnFlgText(NameConst::TYPE_SHORT, $flg);
    }
}
