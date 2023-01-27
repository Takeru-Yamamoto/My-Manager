<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

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

	public function index(Request $request): View|Factory
	{
		$form = new Forms\IndexForm($request->all());

		if ($form->hasError()) throw $form->exception();

		$users = $this->service->getLowerThanRole($form);

		return view('pages.user.index', compact("form", "users"));
	}

	public function createForm(): View|Factory
	{
		return view('pages.user.create');
	}

	public function create(Request $request): Redirector|RedirectResponse
	{
		$form = new Forms\CreateForm($request->all());

		if ($form->hasError()) return $form->redirect();

		return successRedirect("user", $this->service->create($form));
	}

	public function updateForm(int $id): View|Factory
	{
		return view('pages.user.update', ['user' => $this->service->findById($id)]);
	}

	public function update(Request $request): Redirector|RedirectResponse
	{
		$form = new Forms\UpdateForm($request->all());

		if ($form->hasError()) return $form->redirect();

		return successRedirect("user", $this->service->update($form));
	}

	public function delete(Request $request): void
	{
		$form = new Forms\DeleteForm($request->all());

		if ($form->hasError()) throw $form->exception();

		$this->service->delete($form);
	}

	public function changeIsValid(Request $request): void
	{
		$form = new Forms\ChangeIsValidForm($request->all());

		if ($form->hasError()) throw $form->exception();

		$this->service->changeIsValid($form);
	}
}
