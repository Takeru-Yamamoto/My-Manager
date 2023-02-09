<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

use App\Http\Controllers\Controller;
use App\Services\HomeService;

class HomeController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new HomeService;
    }

    public function index(): View
    {
        if (!isLoggedIn()) return $this->guestIndex();
        if (isSystem()) return $this->systemIndex();
        if (isAdmin()) return $this->adminIndex();
        if (isUser()) return $this->userIndex();
    }

    public function systemIndex(): View
    {
        return view("pages.system");
    }

    public function adminIndex(): View
    {
        return view("pages.admin");
    }

    public function userIndex(): View
    {
        return view("pages.user");
    }

    public function guestIndex(): View
    {
        return view("pages.guest");
    }
}
