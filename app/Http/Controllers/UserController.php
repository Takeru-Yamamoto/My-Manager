<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

use App\Http\Controllers\Controller;
use App\Http\Forms\User as Forms;
use App\Services\UserService;

class UserController extends Controller
{
	private $service;

	function __construct()
	{
		$this->service = new UserService;
	}

	public function index(Request $request): View
	{
		$form = new Forms\IndexForm($request->all());

		$users = $this->service->getLowerThanRole($form);

		return view('pages.user.index', compact("form", "users"));
	}

	public function createForm(): View
	{
		return view('pages.user.create');
	}

	public function create(Request $request): RedirectResponse
	{
		$this->service->create(new Forms\CreateForm($request->all()));

		return successRedirect("user.index", text: configText("user_created"));
	}

	public function updateForm(int $id): View
	{
		return view('pages.user.update', ['user' => $this->service->findById(new Forms\UpdatePreparationForm(compact("id")))]);
	}

	public function update(Request $request): RedirectResponse
	{
		$this->service->update(new Forms\UpdateForm($request->all()));

		return successRedirect("user.index", text: configText("user_updated"));
	}

	public function delete(Request $request): void
	{
		$this->service->delete(new Forms\DeleteForm($request->all()));
	}

	public function changeIsValid(Request $request): void
	{
		$this->service->changeIsValid(new Forms\ChangeIsValidForm($request->all()));
	}
}
