<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\StoreRequest;
use App\Services\Posts\PostService;
use App\Services\PublishingService;
use Illuminate\Http\Request;
use App\Models\Post;


class MainController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true
        ]);
    }
}
