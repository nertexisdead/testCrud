<?php

namespace App\Jobs;

use App\Components\Helpers\Elasticsearch;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class SyncPostsIndexJob implements ShouldQueue
{
    use Dispatchable;

    use InteractsWithQueue;

    use Queueable;

    public function handle()
    {
        $client = new Elasticsearch();
        $indexName = 'posts';
//        $client->deleteAllIndices();
        $client->ensureIndexExists($indexName);

        $posts = Post::with('translations')->get();

        foreach ($posts as $post) {
            $translationsByLocale = $post->translations
                ->where('field', 'title')
                ->mapWithKeys(fn($t) => [$t->locale => $t->value])
                ->toArray();

            $document = [
                'id' => $post->id,
                'alias' => $post->alias,
                'title' => $translationsByLocale,
            ];

            $client->indexDocument($indexName, $post->id, $document);
        }
    }
}
