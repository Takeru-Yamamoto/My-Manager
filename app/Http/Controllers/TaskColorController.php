<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

use App\Http\Controllers\Controller;
use App\Http\Forms\TaskColor as Forms;
use App\Services\TaskColorService;

class TaskColorController extends Controller
{
	private $service;

	function __construct()
	{
		$this->service = new TaskColorService;
	}

	public function index(): View|Factory
	{
		$taskColors = $this->service->TaskColorRepository->get();
		$bootstrapColors = config("color.list");

		return view("pages.taskColor.modal", compact("taskColors", "bootstrapColors"));
	}

	public function create(Request $request): string
	{
		$this->service->create(new Forms\CreateForm($request->all()));

		return configText("task_color_created");
	}

	public function update(Request $request): string
	{
		$this->service->update(new Forms\UpdateForm($request->all()));

		return configText("task_color_updated");
	}

	public function delete(Request $request): void
	{
		$this->service->delete(new Forms\DeleteForm($request->all()));
	}
}
