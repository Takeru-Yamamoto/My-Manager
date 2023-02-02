<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

use App\Http\Controllers\Controller;
use App\Http\Forms\TaskColor as Forms;
use App\Services\TaskColorService;

use App\Consts\ContentConst;

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
		$bootstrapColors = ContentConst::BOOTSTRAP_COLORS;

		return view("pages.taskColor.modal", compact("taskColors", "bootstrapColors"));
	}

	public function create(Request $request): string
	{
		$form = new Forms\CreateForm($request->all());

		if ($form->hasError()) throw $form->exception();

		return getTextFromConst($this->service->create($form));
	}

	public function update(Request $request): string
	{
		$form = new Forms\UpdateForm($request->all());

		if ($form->hasError()) throw $form->exception();

		return getTextFromConst($this->service->update($form));
	}

	public function delete(Request $request): void
	{
		$form = new Forms\DeleteForm($request->all());

		if ($form->hasError()) throw $form->exception();

		$this->service->delete($form);
	}
}
