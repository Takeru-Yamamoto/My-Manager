<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

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

    public function showEmailInputForm(): View|Factory
    {
        return view('auth.passwordForgot');
    }

    public function receiveEmailAddress(Request $request): Redirector|RedirectResponse
    {
        $sendPasswordResetMailResult = $this->service->sendPasswordResetMail(new Forms\ReceiveEmailAddressForm($request->all()));

        return $sendPasswordResetMailResult ? successRedirect("password_forgot", configText("email_send_success")) : successRedirect("password_forgot", configText("email_send_failure"));
    }

    public function passwordResetForm(string $token, string $email): View|Factory|Redirector|RedirectResponse
    {
        $form = new Forms\PasswordResetPreparationForm(compact("token", "email"));

        return view('auth.passwordReset', ["email" => $form->email, "token" => $form->token]);
    }

    public function passwordReset(Request $request): Redirector|RedirectResponse
    {
        $this->service->resetPassword(new Forms\PasswordResetForm($request->all()));

        return successRedirect("login", configText("password_reset_success"));
    }
}
