<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct(
        protected SearchService $searchService,
    ) {
    }

    public function index()
    {
        return view('pages.index')->with([
            'title' => __('Posts'),
        ]);
    }

    public function search(Request $request)
    {
        $this->searchService->search($request);
    }
}
