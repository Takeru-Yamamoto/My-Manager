<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

use App\Http\Controllers\Controller;
use App\Http\Forms\LoginInfo as Forms;
use App\Services\LoginInfoService;
use App\Consts\TextConst;

class LoginInfoController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new LoginInfoService;
    }

    public function index(): View|Factory
    {
        return view('pages.loginInfo.index', ['user' => authUserResult()]);
    }

    public function update(Request $request): Redirector|RedirectResponse
    {
        $form = new Forms\UpdateForm($request->all());

        if ($form->hasError()) return $form->redirect("login_info");

        return successRedirect("login_info", $this->service->update($form));
    }

    public function changeEmailForm(): View|Factory
    {
        return view('auth.changeEmail', ['user' => authUserResult()]);
    }

    public function authenticationCodeForm(Request $request): View|Factory|Redirector|RedirectResponse
    {
        $form = new Forms\AuthenticationCodeForm($request->all());

        if ($form->hasError()) return $form->redirect("login_info/change_email");

        $textKey = $this->service->authenticationCodeForm($form);

        if (is_null($textKey)) {
            return view('auth.authenticationCode', ['user' => authUserResult()]);
        }

        return failureRedirect("login_info/change_email_preparation", $textKey);
    }

    public function changeEmail(Request $request): View|Factory|Redirector|RedirectResponse
    {
        $form = new Forms\ChangeEmailForm($request->all());

        if ($form->hasError()) return $form->redirect("login_info/change_email_preparation");

        $textKey = $this->service->changeEmail($form);

        if (is_null($textKey)) {
            return view('auth.authenticationCode', ["auth" => false, 'user' => authUserResult()]);
        }
     
        return divergeRedirect($textKey === TextConst::EMAIL_CHANGED_SUCCESS, "login_info", $textKey);
    }
}
