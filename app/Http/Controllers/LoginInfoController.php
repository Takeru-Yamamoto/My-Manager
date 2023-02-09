<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

use App\Http\Controllers\Controller;
use App\Http\Forms\LoginInfo as Forms;
use App\Services\LoginInfoService;

class LoginInfoController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new LoginInfoService;
    }

    public function index(): View
    {
        return view('pages.loginInfo.index', ['user' => authUserResult()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $this->service->update(new Forms\UpdateForm($request->all()));

        return successRedirect("loginInfo.index", text: configText("login_info_updated"));
    }

    public function changeEmailForm(): View
    {
        return view('pages.loginInfo.changeEmail', ['user' => authUserResult()]);
    }

    public function authenticationCodeForm(Request $request): View|RedirectResponse
    {
        $isSendEmailReset = $this->service->authenticationCodeForm(new Forms\AuthenticationCodeForm($request->all()));

        return $isSendEmailReset ? view('pages.loginInfo.authenticationCode', ['user' => authUserResult()]) : failureRedirect("loginInfo.changeEmailForm", text: configText("email_send_failure"));
    }

    public function changeEmail(Request $request): RedirectResponse
    {
        $form = new Forms\ChangeEmailForm($request->all());

        $changeEmailResult = $this->service->changeEmail($form);

        return $changeEmailResult ? successRedirect("loginInfo.index", text: configText("email_changed_success")) : failureRedirect("loginInfo.index", text: configText("email_changed_success"));
    }
}
