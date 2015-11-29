<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests;
use App\Models\ArticleTagMapper;
use App\Models\Rating;
use App\Models\Tag;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use URL;

class ArticleController extends Controller {

    /**
     * Instantiate a new ArticleController instance.
     *
     */
    public function __construct() {

        $this->middleware('auth', ['only' => [
            'getCreate',
            'postCreate',
            'getDraft',
            'getDelete',
            'postDelete',
            'postRating',
            'postRate',
            'getRate',
        ]]);

        $this->middleware('roles:' . User::TEACHER_ROLE . User::ADMIN_ROLE, ['only' => [
            'getDelete'
        ]]);

        $this->middleware('role:' . User::TEACHER_ROLE, ['only' => [
            'postRate',
            'getRate',
        ]]);
    }

    public function getShow($id) {
        $article = Article::findBySlugOrIdOrFail($id);

        $discussions = $article->discussions()->whereNull('parent')->orderBy('created_at', 'ASC')->get();
        $rating = null;
        $hodnotenie = Rating::where('article_id', '=', $article->id)->where('text', '<>', '')->first();
        if (Auth::check()) {
            $rating = Rating::where('article_id', '=', $article->id)->where('user_id', '=', Auth::id())->first();
        }

        return view('articles.show', [
            'article' => $article,
            'discussions' => $discussions,
            'rating' => $rating,
            'hodnotenie' => $hodnotenie,
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
        $input['task_id'] = $input['task_id'] ? $input['task_id'] : null;

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
            if ($tagName) {
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
        }

        if ($request->ajax()) {

            return response()->json([
                'id' => $article->id,
                'status' => 'success'
            ]);
        } else {

            if ($input['action'] == "Odoslať") {
                flash()->success('Článok bol publikovaný');
                return redirect()->action('UserController@getProfile', ['id' => Auth::user()->slug]);
            } else {

                flash()->success('Článok bol uložený');
                return redirect(URL::action('ArticleController@getDraft', ['id' => $article->slug]));
            }
        }
    }

    public function postDelete(Request $request) {
        if ($request->ajax()) {
            $input = $request->only(['id']);
            $article = Article::findBySlugOrIdOrFail($input['id']);
            ArticleTagMapper::where('article_id', '=', $article->id)->delete();
            $article->delete();

            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    public function getDelete(Request $request, $id) {
        Article::findBySlugOrIdOrFail($id)->delete();

        flash()->success('Článok bol úspešne zmazaný');
        return redirect('/');
    }

    /**
     * Responds to requests to GET /article/draft/{id}
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDraft($id) {
        $article = Article::where('user_id', '=', Auth::id())
            ->where('state', '=', Article::DRAFT)
            ->where(function ($q) use ($id) {
                $q->where('slug', '=', $id)
                    ->orWhere('id', '=', $id);
            })
            ->first();
        if (!$article) {

            return redirect()->action('ArticleController@getCreate');
        }
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

    public function getRate($slug) {
        $article = Article::findBySlugOrId($slug);

        return view('articles.rate', [
            'article' => $article
        ]);
    }

    public function postRate(Request $request) {

        $input = $request->only(['text', 'rating', 'article_id']);
        $input['user_id'] = Auth::id();

        if (!trim(strip_tags($input['text']))) {
            flash()->error('Nevyplnený text');

            return redirect()->back()->withInput($input);
        }
        if ($input['rating'] == 0) {
            flash()->error('Nevyplnené hodnotenie');

            return redirect()->back()->withInput($input);
        }
        if ($input['rating'] < 1 || $input['rating'] > 5) {
            flash()->error('Nesprávne vyplenené hodnotenie');

            return redirect()->back()->withInput($input);
        }

        if ($rating = Rating::where('user_id', '=', $input['user_id'])->where('article_id', '=', $input['article_id'])->first()) {
            $rating->update($input);
        } else {
            Rating::create($input);
        }

        flash()->success('Článok bol ohodnotený');
        return redirect(URL::action('UserController@getGrading', ['id' => Auth::id()]));
    }

    public function postRating(Request $request) {
        $input = $request->only(['rating', 'article_id']);
        $input['user_id'] = Auth::id();

        if ($input['rating'] > 0 && $input['rating'] < 6) {
            if ($rating = Rating::where('user_id', '=', $input['user_id'])->where('article_id', '=', $input['article_id'])->first()) {
                $rating->update($input);
            } else {
                Rating::create($input);
            }
        }

        return response()->json([
            'result' => 'success'
        ]);
    }
}
