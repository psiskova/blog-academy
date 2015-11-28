<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Models\Article;
use App\Models\ArticleTagMapper;
use App\Models\Tag;
use App\Models\User;

Route::get('/', function () {
    $articles = Article::published();
    $search = false;
    if ($search = Request::get('search')) {
        $articles
            ->join('users', 'users.id', '=', 'articles.user_id')
            ->where(function ($q) use ($search) {
                $q
                    ->where('title', 'like', '%' . $search . '%')
                    ->orWhere(function ($query) use ($search) {
                        $query->where('users.name', 'like', '%' . $search . '%')
                            ->orWhere('users.surname', 'like', '%' . $search . '%')
                            ->orWhere(DB::raw('concat(users.name, \' \', users.surname)'), 'like', '%' . $search . '%');
                    })
                    ->orWhere(function ($query) use ($search) {
                        $tag = array_flatten(Tag::where('name', 'like', '%' . $search . '%')->get(['id'])->toArray());
                        $articleTagMapper = array_flatten(ArticleTagMapper::whereIn('tag_id', $tag)->distinct()->get(['article_id'])->toArray());

                        $query->whereIn('articles.id', $articleTagMapper);
                    });
            });
    }
    $articles = $articles->orderBy('articles.updated_at', 'desc')->select(DB::raw('articles.id, articles.text, articles.title, articles.slug, articles.user_id, articles.updated_at'))->paginate(5);

    $topUsers = Article::published()
        ->limit(3)
        ->groupBy('user_id')
        ->orderByRaw('count(user_id) DESC')
        ->get();

    $bestUsers = User::all();
    $bestUsers = collect($bestUsers->sortByDesc(function ($user) {

        return $user->average_rating;
    }))->reject(function ($user) {

        return $user->average_rating == 0;
    });

    $bestUsers = $bestUsers->slice(0, 3);
    return view('index', [
        'articles' => $articles,
        'topUsers' => $topUsers,
        'bestUsers' => $bestUsers,
        'search' => $search
    ]);
});

Route::get('/about-us', function () {
    return view('aboutus');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/rules', function () {
    return view('rules');
});

Route::get('/migrate/{id}', function () {
    Artisan::call('migrate', [
        '--force' => true,
    ]);
})->where('id', 'lesna_jahoda');

Route::get('/seed/{id}', function () {
    Artisan::call('db:seed', [
        '--force' => true,
    ]);
})->where('id', 'lesna_jahoda');

Route::get('/refresh/{id}', function () {
    Artisan::call('migrate:refresh', [
        '--force' => true,
    ]);
})->where('id', 'lesna_jahoda');

Route::controller('auth', \Auth\AuthController::class);
Route::controller('password', \Auth\PasswordController::class);
Route::controller('article', ArticleController::class);
Route::controller('discussion', DiscussionController::class);
Route::controller('course', CourseController::class);
Route::controller('user', UserController::class);
Route::controller('search', SearchController::class);
Route::controller('task', TaskController::class);
