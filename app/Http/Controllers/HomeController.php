<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;

use App\Http\Controllers\Controller;
use App\Services\HomeService;

class HomeController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new HomeService;
    }

    public function index(): View|Factory
    {
        if (isSystem()) return $this->systemIndex();
        if (isAdmin()) return $this->adminIndex();
        if (isUser()) return $this->userIndex();
    }

    public function systemIndex(): View|Factory
    {
        return view("pages.system");
    }

    public function adminIndex(): View|Factory
    {
        return view("pages.admin");
    }

    public function userIndex(): View|Factory
    {
        $attendance = $this->service->getAttendance();
        $tasks = $this->service->getTodaysTask();
        return view("pages.user", compact("attendance", "tasks"));
    }
}
