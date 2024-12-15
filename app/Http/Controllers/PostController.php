<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\StoreRequest;
use App\Services\Posts\PostService;
use App\Services\PublishingService;
use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function __construct(
        protected PostService $postService,
        protected PublishingService $publishingService,
    ) {
    }

    public function index()
    {
        return view('posts.index')->with([
            'title' => __('Posts'),
        ]);
    }

    public function create()
    {
        return view('posts.create')->with([
            'title' => __('Create post'),
        ]);
    }

    public function save(StoreRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails()) {
            return response()->json(['errors' => $request->validator->errors()], 500);
        }

        $this->postService->save($request);

        return response()->json([
            'message' => __('The post was successfully created.'),
            'redirect' => route('posts.index'),
        ], 200);
    }

    public function edit(Post $post)
    {
        return view('posts.edit')->with([
            'post' => $post,
            'title' => __('Edit post'),
        ]);
    }

    public function update(StoreRequest $request, Post $post)
    {
        $this->postService->update($request, $post);

        return response()->json([
            'message' => __('The post was successfully updated.'),
            'redirect' => route('posts.index'),
        ], 200);
    }

    public function destroy(Post $post)
    {
        $this->postService->delete($post);
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function togglePublish(Post $post)
    {
        $this->publishingService->toggler($post);

        return response()->json([
            'message' => __('The post was successfully toggled ' . (int)$post->isActive()),
        ], 200);
    }
}
