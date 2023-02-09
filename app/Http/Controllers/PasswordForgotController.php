<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

use App\Http\Controllers\Controller;
use App\Http\Forms\PasswordForgot as Forms;
use App\Services\PasswordForgotService;

class PasswordForgotController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new PasswordForgotService;
    }

    public function showEmailInputForm(): View
    {
        return view('auth.passwordForgot');
    }

    public function receiveEmailAddress(Request $request): RedirectResponse
    {
        $sendPasswordResetMailResult = $this->service->sendPasswordResetMail(new Forms\ReceiveEmailAddressForm($request->all()));

        return $sendPasswordResetMailResult ? successRedirect("showEmailInputForm", text: configText("email_send_success")) : failureRedirect("showEmailInputForm", text: configText("email_send_failure"));
    }

    public function passwordResetForm(string $token, string $email): View|RedirectResponse
    {
        $form = new Forms\PasswordResetPreparationForm(compact("token", "email"));

        return view('auth.passwordReset', ["email" => $form->email, "token" => $form->token]);
    }

    public function passwordReset(Request $request): RedirectResponse
    {
        $this->service->resetPassword(new Forms\PasswordResetForm($request->all()));

        return successRedirect("login", text: configText("password_reset_success"));
    }
}
