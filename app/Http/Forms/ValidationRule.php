<?php

namespace App\Http\Forms;

class ValidationRule
{
    const EMAIL             = 'string|max:100|email';
    const FLG_INTEGER       = 'integer|min:0|max:1';
    const PASSWORD          = 'string|min:8|max:32';
    const BOOLEAN           = 'boolean';
    const CODE              = 'string|max:100|regex:/^[A-Za-z\d_-]+$/';
    const COLOR_HEX_CODE    = 'string|size:7|regex:/^#[A-Za-z\d_-]{6}/';
    const INTEGER           = 'integer|max:999999999';
    const NAME              = 'string|max:100';
    const POSITIVE          = 'numeric|min:0';
    const POSITIVE_INTEGER  = 'integer|min:0|max:999999999';
    const POSITIVE_NON_ZERO = 'numeric|min:0|not_in:0';
    const STRING            = 'string|max:250';
    const TEXT              = 'string|max:500';
    const LONG_TEXT         = 'string';
    const SIX_DIGIT_CODE    = 'string|regex:/^[0-9]{6}$/';
    const DATE              = 'string|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
    const TIME              = 'string|regex:/^[0-9]{2}:[0-9]{2}:[0-9]{2}$/';
    const MONTH             = 'string|regex:/^[0-9]{4}-[0-9]{2}$/';
    const POST_CODE         = 'string|regex:/^[0-9]{7}$/';
}
