<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Forms\Search as Forms;
use App\Services\SearchService;

class SearchController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new SearchService;
    }

    public function search(Request $request): array|null
    {
        $form = new Forms\SearchForm($request->all());

        if ($form->hasError()) throw $form->exception();

        return $this->service->search($form);
    }
}
