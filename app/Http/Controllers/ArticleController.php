<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests;
use App\Models\ArticleTagMapper;
use App\Models\Tag;
use Auth;
use Illuminate\Http\Request;
use URL;

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

    /**
     * Responds to requests to GET /article/create
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate() {

        return view('articles.create');
    }

    /**
     * Responds to requests to POST /article/create
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postCreate(Request $request) {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['tags'] = array_map('trim', explode(',', $input['tags']));

        if ($input['action'] == "Odoslať") {
            $input['state'] = Article::PUBLISHED;
        } else {
            $input['state'] = Article::DRAFT;
        }

        if ($article = Article::findBySlugOrId($input['id'])) {
            $article->update($input);
            $article->resluggify()->save();
        } else {
            $article = Article::create($input);
        }
        ArticleTagMapper::where('article_id', '=', $article->id)->delete();
        foreach ($input['tags'] as $tagName) {
            if (!($tag = Tag::where('name', '=', $tagName)->first())) {
                $tag = Tag::create([
                    'name' => $tagName
                ]);
            }
            ArticleTagMapper::create([
                'article_id' => $article->id,
                'tag_id' => $tag->id
            ]);
        }

        if ($request->ajax()) {

            return response()->json([
                'id' => $article->id,
                'status' => 'success'
            ]);
        } else {

            if ($input['action'] == "Odoslať") {
                flash()->success('Článok bol publikovaný');
                return redirect('/');
            } else {

                flash()->success('Článok bol uložený');
                return redirect(URL::action('ArticleController@getDraft', ['id' => $article->slug]));
            }
        }
    }

    public function postDelete(Request $request) {
        if ($request->ajax()) {
            $input = $request->only(['id']);
            $article = Article::findBySlugOrId($input['id']);
            ArticleTagMapper::where('article_id', '=', $article->id)->delete();
            $article->delete();

            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    /**
     * Responds to requests to GET /article/draft/{id}
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDraft($id) {
        $article = Article::findBySlugOrId($id);
        $tags = implode(',', array_flatten($article->tags()->get(['name'])->toArray()));

        return view('articles.create', [
            'article' => $article,
            'tags' => $tags
        ]);
    }

    public function getMyDrafts() {
        $drafts = Auth::user()->articles()->draft()->orderBy('updated_at', 'DESC')->get();

        return view('articles.mydrafts', [
            'drafts' => $drafts
        ]);
    }

    public function getMyArticles() {
        $articles = Auth::user()->articles()->published()->get();

        return view('articles.myarticles', [
            'articles' => $articles
        ]);
    }

    public function getManagement() {

        return view('articles.management');
    }

    public function getRateArticle($slug) {
        $article = Article::findBySlugOrId($slug);

        return view('articles.ratearticle', [
            'article' => $article
        ]);
    }
}
