<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

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

	public function index(Request $request): View|RedirectResponse
	{
		if (!isUser()) return redirect()->route("attendance.adminIndex");

		$form = new Forms\IndexForm($request->all());

		$attendances       = $this->service->getPaginatedAttendances($form);
		$attendanceInMonth = $this->service->getAttendanceInMonth(authUserId(), $form->month);

		$dateUtil          = dateUtil($form->month);
		$addMonth          = $dateUtil->copy()->addMonth(1);
		$subMonth          = $dateUtil->copy()->subMonth(1);

		return view('pages.attendance.index', compact("form", "attendances", "attendanceInMonth", "dateUtil", "subMonth", "addMonth"));
	}

	public function create(Request $request): RedirectResponse
	{
		$form = new Forms\CreateForm($request->all());

		$this->service->create($form);

		return successRedirect("attendance.index", text: configText("attendance_created"), addText: "勤怠種別: " . getAttendanceTypeText($form->type));
	}

	public function adminIndex(Request $request): View
	{
		$form = new Forms\AdminIndexForm($request->all());

		$attendanceInMonths = $this->service->getUserAttendanceInMonth($form);
		$dateUtil           = dateUtil($form->month);
		$addMonth           = $dateUtil->copy()->addMonth(1);
		$subMonth           = $dateUtil->copy()->subMonth(1);

		return view('pages.attendance.adminIndex', compact("form", "attendanceInMonths", "dateUtil", "subMonth", "addMonth"));
	}
}
