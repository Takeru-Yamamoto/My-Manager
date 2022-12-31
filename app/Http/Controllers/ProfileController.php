<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

use App\Http\Controllers\Controller;
use App\Http\Forms\Profile as Forms;
use App\Services\ProfileService;

class ProfileController extends Controller
{
	private $service;

	function __construct()
	{
		$this->service = new ProfileService;
	}

	public function index(): View|Factory
	{
		return view('pages.profile.index', ['profile' => $this->service->getLoggedInUserProfile()]);
	}

	public function update(Request $request): Redirector|RedirectResponse
	{
		$form = new Forms\UpdateForm($request->all());

		if ($form->hasError()) return $form->redirect("profile");

		return successRedirect("profile", $this->service->update($form));
	}
}
