<?php

/* class */
if (!function_exists('btnCreate')) {
    function btnCreate(): string
    {
        return config("btn.class.create");
    }
}
if (!function_exists('btnUpdate')) {
    function btnUpdate(): string
    {
        return config("btn.class.update");
    }
}
if (!function_exists('btnDelete')) {
    function btnDelete(): string
    {
        return config("btn.class.delete");
    }
}
if (!function_exists('btnChange')) {
    function btnChange(): string
    {
        return config("btn.class.change");
    }
}
if (!function_exists('btnFlg')) {
    function btnFlg(int $flg): string
    {
        if($flg === 0) return config("btn.class.true");
        if($flg === 1) return config("btn.class.false");
        return "";
    }
}
if (!function_exists('btnLink')) {
    function btnLink(): string
    {
        return config("btn.class.link");
    }
}
if (!function_exists('btnInfo')) {
    function btnInfo(): string
    {
        return config("btn.class.info");
    }
}
if (!function_exists('btnSpinner')) {
    function btnSpinner(): string
    {
        return config("btn.class.spinner");
    }
}
if (!function_exists('btnModal')) {
    function btnModal(): string
    {
        return config("btn.class.modal");
    }
}
if (!function_exists('btnModalAjax')) {
    function btnModalAjax(): string
    {
        return config("btn.class.modal-ajax");
    }
}
if (!function_exists('btnFormSubmit')) {
    function btnFormSubmit(): string
    {
        return config("btn.class.form-submit");
    }
}
if (!function_exists('btnBlock')) {
    function btnBlock(): string
    {
        return config("btn.class.block");
    }
}
if (!function_exists('btnRight')) {
    function btnRight(): string
    {
        return config("btn.class.right");
    }
}
if (!function_exists('btnSmall')) {
    function btnSmall(): string
    {
        return config("btn.class.small");
    }
}

/* text */
if (!function_exists('btnCreateText')) {
    function btnCreateText(): string
    {
        return config("btn.text.create");
    }
}
if (!function_exists('btnUpdateText')) {
    function btnUpdateText(): string
    {
        return config("btn.text.update");
    }
}
if (!function_exists('btnDeleteText')) {
    function btnDeleteText(): string
    {
        return config("btn.text.delete");
    }
}
if (!function_exists('btnChangeText')) {
    function btnChangeText(): string
    {
        return config("btn.text.change");
    }
}
if (!function_exists('btnFlgText')) {
    function btnFlgText(int $flg): string
    {
        if($flg === 0) return config("btn.text.true");
        if($flg === 1) return config("btn.text.false");
        return "";
    }
}
