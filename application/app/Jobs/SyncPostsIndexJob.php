<?php

namespace App\Jobs;

use App\Components\Helpers\Elasticsearch;
use App\Models\Post;
use App\Models\Synonim;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

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
//        dd(123);
        $synonyms = Synonim::all()->map(function($item) {
            return "{$item->word}, {$item->synonym}";
        })->toArray();
        $client->ensureIndexExists($indexName, $synonyms);

        $posts = Post::with('translations')->get();

        foreach ($posts as $post) {
            $translationsByLocale = $post->translations
                ->where('field', 'title')
                ->mapWithKeys(fn($t) => [$t->locale => $t->value])
                ->toArray();
            if (!empty($translationsByLocale)) {
                $document = [
                    'id' => $post->id,
                    'alias' => $post->alias,
                    'title' => $translationsByLocale,
                ];

                $client->indexDocument($indexName, $post->id, $document);
            }
        }
    }
}
