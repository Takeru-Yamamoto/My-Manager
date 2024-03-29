<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

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

	public function index(): View
	{
		return view('pages.task.index');
	}

	public function fetch(Request $request): JsonResponse
	{
		$form = new Forms\FetchForm($request->all());

		return $this->service->fetch($form);
	}

	public function createModal(Request $request): View
	{
		$form = new Forms\CreateModalForm($request->all());

		$taskColors = $this->service->TaskColorRepository->get();

		return view("pages.task.createFormModal", compact("form", "taskColors"));
	}

	public function create(Request $request): RedirectResponse
	{
		$this->service->create(new Forms\CreateForm($request->all()));

		return successRedirect("task.index", text: configText("task_created"));
	}

	public function updateModal(Request $request): View
	{
		$form = new Forms\UpdateModalForm($request->all());

		$task       = $this->service->TaskRepository->findById($form->id);
		$taskColors = $this->service->TaskColorRepository->get();

		return view("pages.task.updateFormModal", compact("task", "taskColors"));
	}

	public function update(Request $request): RedirectResponse
	{
		$this->service->update(new Forms\UpdateForm($request->all()));

		return successRedirect("task.index", text: configText("task_updated"));
	}

	public function delete(Request $request): void
	{
		$form = new Forms\DeleteForm($request->all());

		$this->service->delete($form);
	}
}
