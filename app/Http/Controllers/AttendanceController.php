<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

use App\Http\Controllers\Controller;
use App\Http\Forms\Attendance as Forms;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
	private $service;

	function __construct()
	{
		$this->service = new AttendanceService;
	}

	public function index(Request $request): View|Factory
	{
		$form = new Forms\IndexForm([
			"month" => $request->month,
			"page"  => $request->page,
			"path"  => $request->path(),
		]);

		if ($form->hasError()) throw $form->exception();

		$attendances       = $this->service->getPaginatedAttendances($form);
		$attendanceInMonth = $this->service->getAttendanceInMonth($form);

		return view('pages.attendance.index', compact("attendances", "attendanceInMonth"));
	}

	public function create(Request $request): Redirector|RedirectResponse
	{
		$form = new Forms\CreateForm($request->all());

		if ($form->hasError()) return $form->redirect("attendance");

		return successRedirect("attendance", $this->service->create($form), "勤怠種別: " . getAttendanceTypeText($form->type));
	}
}
