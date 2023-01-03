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
        if (isSystem()) {
            return view("pages.system");
        } elseif (isAdmin()) {
            return view("pages.admin");
        } else {
            $attendance = $this->service->getAttendance();
            $tasks = $this->service->getTodaysTask();
            return view("pages.user", compact("attendance", "tasks"));
        }
    }
}
