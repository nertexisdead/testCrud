<?php

namespace App\Services\Posts;

use App\Http\Requests\Posts\StoreRequest;
use App\Models\Post;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;

class PostService
{
    public function save(StoreRequest $request): Post|JsonResponse
    {
        $post = Post::create(
            $request->all()
        );

        return $post;
    }

    public function update(StoreRequest $request, Post $post): Post
    {
        $post->update(
            $request->all()
        );

        return $post;
    }

    public function delete(Post $post): void
    {
        $post->delete();
    }

    public function getContent(Post $post)
    {
        return $post->content;
    }
}
