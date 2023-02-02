<?php

use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

if (!function_exists('successRedirect')) {
    function successRedirect(string $path, string $textKey, string $addText = null): Redirector|RedirectResponse
    {
        return redirect($path)->with('success_message', getTextFromConst($textKey) . "\n" . $addText);
    }
}
if (!function_exists('failureRedirect')) {
    function failureRedirect(string $path, string $textKey, string $addText = null): Redirector|RedirectResponse
    {
        return redirect($path)->with('danger_message', getTextFromConst($textKey) . "\n" . $addText);
    }
}
if (!function_exists('divergeRedirect')) {
    function divergeRedirect(bool $flg, string $path, string $textKey, string $addText = null): Redirector|RedirectResponse
    {
        return $flg ? successRedirect($path, $textKey, $addText) : failureRedirect($path, $textKey, $addText);
    }
}
