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
        $this->service->update(new Forms\UpdateForm($request->all()));

        return successRedirect("login_info", configText("login_info_updated"));
    }

    public function changeEmailForm(): View|Factory
    {
        return view('pages.loginInfo.changeEmail', ['user' => authUserResult()]);
    }

    public function authenticationCodeForm(Request $request): View|Factory|Redirector|RedirectResponse
    {
        $isSendEmailReset = $this->service->authenticationCodeForm(new Forms\AuthenticationCodeForm($request->all()));

        return $isSendEmailReset ? view('pages.loginInfo.authenticationCode', ['user' => authUserResult()]) : failureRedirect("login_info/change_email", configText("email_send_failure"));
    }

    public function changeEmail(Request $request): Redirector|RedirectResponse
    {
        $form = new Forms\ChangeEmailForm($request->all());

        $changeEmailResult = $this->service->changeEmail($form);

        return $changeEmailResult ? successRedirect("login_info", configText("email_changed_success")) : failureRedirect("login_info", "email_changed_expired");
    }
}
