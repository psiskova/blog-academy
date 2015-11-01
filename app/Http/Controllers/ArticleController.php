<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests;

class ArticleController extends Controller {

    /**
     * Instantiate a new ArticleController instance.
     *
     */
    public function __construct() {

    }

    /**
     * Responds to requests to GET /article
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex() {

        return view('articles.index');
    }

    public function getShow($id) {
        $article = Article::findBySlugOrId($id);

        return view('articles.show', [
            'article' => $article
        ]);
    }

    public function getCreate($id = null) {
        $article = Article::findBySlugOrId($id);

        return view('articles.create', [
            'article' => $article
        ]);
    }

    public function getManagement() {

        return view('articles.management');
    }
}
