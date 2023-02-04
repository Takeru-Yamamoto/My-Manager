<?php

use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

if (!function_exists('successRedirect')) {
    function successRedirect(string $path, string $text, string $addText = null): Redirector|RedirectResponse
    {
        return redirect($path)->with('success_message', $text . "\n" . $addText);
    }
}
if (!function_exists('failureRedirect')) {
    function failureRedirect(string $path, string $text, string $addText = null): Redirector|RedirectResponse
    {
        return redirect($path)->with('danger_message', $text . "\n" . $addText);
    }
}
if (!function_exists('previousRedirect')) {
    function previousRedirect(string $text, string $addText = null): Redirector|RedirectResponse
    {
        return redirect(url()->previous())->with('danger_message', $text . "\n" . $addText);
    }
}
