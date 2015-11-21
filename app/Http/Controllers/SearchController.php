<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleTagMapper;
use App\Models\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller {
    public function getSearch(Request $request) {
        $search = $request->get('query');
        $articles = Article::published()
            ->join('users', 'users.id', '=', 'articles.user_id')
            ->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere(function ($query) use ($search) {
                        $query->where('users.name', 'like', '%' . $search . '%')
                            ->orWhere('users.surname', 'like', '%' . $search . '%')
                            ->orWhere(DB::raw('concat(users.name, \' \', users.surname)'), 'like', '%' . $search . '%');
                    })
                    ->orWhere(function ($query) use ($search) {
                        $tag = array_flatten(Tag::where('name', 'like', '%' . $search . '%')->get(['id'])->toArray());
                        $articleTagMapper = array_flatten(ArticleTagMapper::whereIn('tag_id', $tag)->distinct()->get(['article_id'])->toArray());

                        $query->whereIn('id', $articleTagMapper);
                    });
            })->get(['articles.id', 'articles.title']);

        return response()->json($articles);
    }
}
