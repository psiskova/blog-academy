<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;

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

    public function getCreate() {

        return view('articles.create');
    }

    public function postCreate(Request $request) {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $article = Article::create($input);
        $article->update([
            'state' => Article::PUBLISHED
        ]);
        // TODO tags, text

        if ($request->ajax()) {

            return response()->json([
                'id' => $article->id,
                'status' => 'success'
            ]);
        } else {

            flash()->success('Článok bol publikovaný');
            return redirect('/');
        }
    }

    public function getDraft($id) {
        $article = Article::findBySlugOrId($id);
        $tags = $article->tags;
        $tags_name = '';
        foreach ($tags as $tag) {
            if ($tags_name !== '') {
                $tags_name .= ', ';
            }
            $tags_name .= $tag->name;
        }

        return view('articles.create', [
            'article' => $article,
            'tags' => $tags_name
        ]);
    }

    public function getMyDrafts() {
        $drafts = Article::where('user_id', '=', Auth::id())->where('state', '=', Article::DRAFT)->get();

        return view('articles.mydrafts', [
                'drafts' => $drafts
            ]);
    }

    public function getMyArticles() {
        $articles = Article::where('user_id', '=', Auth::id())->where('state', '=', Article::PUBLISHED)->get();

        return view('articles.myarticles', [
                'articles' => $articles
            ]);
    }

    public function getManagement() {

        return view('articles.management');
    }
}
