<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

use App\Http\Controllers\Controller;
use App\Http\Forms\Task as Forms;
use App\Services\TaskService;

use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
	private $service;

	function __construct()
	{
		$this->service = new TaskService;
	}

	public function index(): View|Factory
	{
		return view('pages.task.index');
	}

	public function fetch(Request $request): JsonResponse
	{
		$form = new Forms\FetchForm($request->all());

		if ($form->hasError()) throw $form->exception();

		return $this->service->fetch($form);
	}

	public function createModal(Request $request): View|Factory
	{
		$form = new Forms\CreateModalForm($request->all());

		if ($form->hasError()) throw $form->exception();

		$taskColors = $this->service->TaskColorRepository->get();

		return view("pages.task.createFormModal", compact("form", "taskColors"));
	}

	public function create(Request $request): Redirector|RedirectResponse
	{
		$form = new Forms\CreateForm($request->all());

		if ($form->hasError()) return $form->redirect();

		return successRedirect("task", $this->service->create($form));
	}

	public function updateModal(Request $request): View|Factory
	{
		$form = new Forms\UpdateModalForm($request->all());

		if ($form->hasError()) throw $form->exception();

		$task       = $this->service->TaskRepository->findById($form->id);
		$taskColors = $this->service->TaskColorRepository->get();

		return view("pages.task.updateFormModal", compact("task", "taskColors"));
	}

	public function update(Request $request): Redirector|RedirectResponse
	{
		$form = new Forms\UpdateForm($request->all());

		if ($form->hasError()) return $form->redirect();

		return successRedirect("task", $this->service->update($form));
	}

	public function delete(Request $request): void
	{
		$form = new Forms\DeleteForm($request->all());

		if ($form->hasError()) throw $form->exception();

		$this->service->delete($form);
	}
}
