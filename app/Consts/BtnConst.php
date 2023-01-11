<?php

namespace App\Consts;

use App\Consts\NameConst;

class BtnConst
{
    public const LINK        = "link";
    public const SPINNER     = "spinner";
    public const MODAL       = "modal";
    public const MODAL_AJAX  = "modal_ajax";

    public const FORM_SUBMIT = "form_submit";
    public const RIGHT       = "right";
    public const BLOCK       = "block";
    public const SMALL       = "small";

    public const BTN_CLASS_MAP = [
        NameConst::CREATE => "btn btn-primary",
        NameConst::UPDATE => "btn btn-success",
        NameConst::DELETE => "btn btn-danger delete-btn",
        NameConst::CHANGE => "btn btn-warning",
        NameConst::TRUE   => "btn btn-light flg-change-btn",
        NameConst::FALSE  => "btn btn-secondary flg-change-btn",

        self::LINK        => "btn btn-link",
        self::SPINNER     => "btn btn-info start-spinner-btn",
        self::MODAL       => "btn btn-info modal-btn",
        self::MODAL_AJAX  => "btn btn-info ajax-modal-btn",

        self::FORM_SUBMIT => "form-submit-btn",
        self::BLOCK       => "btn-block",
        self::RIGHT       => "float-right",
        self::SMALL       => "btn-sm",
    ];
}
