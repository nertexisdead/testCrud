<?php

namespace App\Services\Posts;

use App\Http\Requests\Posts\StoreRequest;
use App\Models\Post;
use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;

class PostService
{
    public function updateOrCreatePost($request, Post $post = null): Post
    {
        if (!$post) {
            $post = Post::create($request->all());
        } else {
            $post->update($request->all());
        }

        foreach (config('app.availables_locales') as $locale) {
            foreach (['title', 'content'] as $field) {
                $value = $request->input($field . '.' . $locale);

                if ($value !== null) {
                    $post->translations()->updateOrCreate(
                        [
                            'locale' => $locale,
                            'field' => $field,
                        ],
                        [
                            'field' => $field,
                            'value' => $value,
                        ]
                    );
                }
            }
        }

        return $post;
    }

    public function save(StoreRequest $request): Post|JsonResponse
    {
        return $this->updateOrCreatePost($request);
    }

    public function update(StoreRequest $request, Post $post): Post
    {
        return $this->updateOrCreatePost($request, $post);
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
