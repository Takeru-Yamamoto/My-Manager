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

	public function index(Request $request): View|Factory|Redirector|RedirectResponse
	{
		if (!isUser()) return redirect("attendance/admin");

		$form = new Forms\IndexForm($request->all());

		if ($form->hasError()) throw $form->exception();

		$attendances       = $this->service->getPaginatedAttendances($form);
		$attendanceInMonth = $this->service->getAttendanceInMonth(authUserId(), $form->month);

		$dateUtil          = dateUtil($form->month);
		$addMonth          = $dateUtil->copy()->addMonth(1);
		$subMonth          = $dateUtil->copy()->subMonth(1);

		return view('pages.attendance.index', compact("form", "attendances", "attendanceInMonth", "dateUtil", "subMonth", "addMonth"));
	}

	public function create(Request $request): Redirector|RedirectResponse
	{
		$form = new Forms\CreateForm($request->all());

		if ($form->hasError()) return $form->redirect();

		return successRedirect("attendance", $this->service->create($form), "勤怠種別: " . getAttendanceTypeText($form->type));
	}

	public function adminIndex(Request $request): View|Factory
	{
		$form = new Forms\AdminIndexForm($request->all());

		if ($form->hasError()) throw $form->exception();

		$attendanceInMonths = $this->service->getUserAttendanceInMonth($form);
		$dateUtil           = dateUtil($form->month);
		$addMonth           = $dateUtil->copy()->addMonth(1);
		$subMonth           = $dateUtil->copy()->subMonth(1);

		return view('pages.attendance.adminIndex', compact("form", "attendanceInMonths", "dateUtil", "subMonth", "addMonth"));
	}
}
