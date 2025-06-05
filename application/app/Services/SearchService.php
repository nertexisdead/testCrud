<?php

namespace App\Services;

use App\Models\Post;
use Elastic\ScoutDriverPlus\Support\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SearchService
{
    public function search(Request $request)
    {
        $q = $request->get('q');
        try {
            $query = Query::bool()->must(
                Query::multiMatch()
                    ->fields(['title.ru', 'title.uz'])
                    ->query($q)
                    ->type('best_fields')
                    ->fuzziness('AUTO')
            );

            $queryBuilder = Post::searchQuery($query);

            $queryBuilder->sort('_score', 'desc');

            $queryBuilder->from(0)->size(50);

            // Выполняем поиск
            $searchResult = $queryBuilder->execute();

            $total = $searchResult->total();

            $postsIds = array_map(function ($hit) {
                return $hit['_id'];
            }, $searchResult->raw()['hits']['hits']);

            $posts = [];
            foreach ($postsIds as $postId) {
                $postItem = Post::where('id', $postId)->first();
                if ($postItem) {
                    $posts[] = $postItem;
                }
            }

            return [
                'posts' => collect($posts),
                'total' => $total,
            ];
        } catch (\Throwable $e) {
            Log::error('Elasticsearch is unavailable: ' . $e->getMessage());
            return response()->json(['error' => 'Elasticsearch is unavailable'], 500);
        }
    }
}
