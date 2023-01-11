<?php

namespace App\Http\Forms;

class ValidationRule
{
    const
        EMAIL                    = 'string|max:100|email',
        FLG_INTEGER              = 'integer|min:0|max:1',
        PASSWORD                 = 'string|min:8|max:32',
        VALUE_BOOLEAN            = 'boolean',
        VALUE_CODE               = 'string|max:100|regex:/^[A-Za-z\d_-]+$/',
        VALUE_COLOR_HEX_CODE     = 'string|size:7|regex:/^#[A-Za-z\d_-]{6}/',
        VALUE_INTEGER            = 'integer|max:999999999',
        VALUE_NAME               = 'string|max:100',
        VALUE_POSITIVE           = 'numeric|min:0',
        VALUE_POSITIVE_INTEGER   = 'integer|min:0|max:999999999',
        VALUE_POSITIVE_NON_ZERO  = 'numeric|min:0|not_in:0',
        VALUE_STRING             = 'string|max:250',
        VALUE_TEXT               = 'string|max:500',
        VALUE_SIX_DIGIT_CODE     = 'string|regex:/^[0-9]{6}$/',
        VALUE_DATE               = 'string|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',
        VALUE_MONTH              = 'string|regex:/^[0-9]{4}-[0-9]{2}$/';
}
