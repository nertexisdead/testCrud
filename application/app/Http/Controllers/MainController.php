<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\SearchService;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
        $result = $this->searchService->search($request);

        $view = view('pages.posts.items', [
            'posts' => $result['posts'],
        ])->render();
        return response()->json([
            'success' => true,
            'view' => $view,
        ]);
    }
}
