<?php

namespace App\Services;

use App\Models\Post;
use Elastic\ScoutDriverPlus\Support\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchService
{
    public function search(Request $request)
    {
        $q = $request->get('q');
//        try {
//            $query = Query::bool()->must(
//                Query::multiMatch()
//                    ->fields(['title.ru', 'title.en'])
//                    ->query($q)
//                    ->type('best_fields')
//                    ->fuzziness('AUTO')
//            );
//
//            $queryBuilder = Post::searchQuery($query);
//
//            $queryBuilder->sort('_score', 'desc');
//
//            $queryBuilder->from(0)->size(20);
//
//            // Выполняем поиск
//            $searchResult = $queryBuilder->execute();
//
//            dd($searchResult);
//
//            $total = $searchResult->total();
//
//            $posts = [];
//
//            return [
//                'posts' => $posts,
//                'total' => $total,
//            ];
//        } catch (\Throwable $e) {
//            dd($e->getMessage());
//            Log::error('Elasticsearch is unavailable: ' . $e->getMessage());
//            return response()->json(['error' => 'Elasticsearch is unavailable'], 500);
//        }
    }
}
