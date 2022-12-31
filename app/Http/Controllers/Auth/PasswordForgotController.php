<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

use App\Http\Controllers\Controller;
use App\Http\Forms\Auth as Forms;
use App\Services\Auth\PasswordForgotService;

use App\Consts\TextConst;

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

    public function recieveEmailAddress(Request $request): Redirector|RedirectResponse
    {
        $form = new Forms\RecieveEmailAddressForm($request->all());

		if ($form->hasError()) return $form->redirect("password_forgot");

        $textKey = $this->service->sendPasswordResetMail($form);

        return divergeRedirect($textKey === TextConst::EMAIL_SEND_SUCCESS, "password_forgot", $textKey);
    }

    public function passwordResetForm(string $token, string $email): View|Factory|Redirector|RedirectResponse
    {
        $form = new Forms\PasswordResetPreperationForm(compact("token", "email"));

		if ($form->hasError()) throw $form->exception();

        $textKey = $this->service->checkTokenAndEmailExist($form);

        if (is_null($textKey)) {
            return view('auth.passwordReset', ["email" => $form->email, "token" => $form->token]);
        }
     
        return failureRedirect("password_forgot", $textKey);
    }

    public function passwordReset(Request $request): Redirector|RedirectResponse
    {
        $form = new Forms\PasswordResetForm($request->all());

		if ($form->hasError()) return $form->redirect("password_reset/" . $request->token . "/" . $request->email);

        return successRedirect("login", $this->service->resetPassword($form));
    }
}
