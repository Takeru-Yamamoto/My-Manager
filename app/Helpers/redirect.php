<?php

use Illuminate\Http\RedirectResponse;

if (!function_exists('successRedirect')) {
    function successRedirect(string $route, array $params = [], string $text = null, string $addText = null): RedirectResponse
    {
        return redirect()->route($route, $params)->with('success_message', $text . "\n" . $addText);
    }
}
if (!function_exists('failureRedirect')) {
    function failureRedirect(string $route, array $params = [], string $text = null, string $addText = null): RedirectResponse
    {
        return redirect()->route($route, $params)->with('danger_message', $text . "\n" . $addText);
    }
}
if (!function_exists('previousRedirect')) {
    function previousRedirect(string $text, string $addText = null): RedirectResponse
    {
        return redirect(url()->previous())->with('danger_message', $text . "\n" . $addText);
    }
}
