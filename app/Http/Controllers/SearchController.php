<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller {
    public function getSearch(Request $request) {
        $search = $request->get('query');
        $articles = Article::published()
            ->join('users', 'users.id', '=', 'articles.user_id')
            ->where('title', 'like', '%' . $search . '%')
            ->orWhere(function ($query) use ($search) {
                $query->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.surname', 'like', '%' . $search . '%');
            })->get(['articles.id', 'articles.title']);

        return response()->json($articles);
    }
}
