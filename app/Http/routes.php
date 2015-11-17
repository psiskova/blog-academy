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

Route::get('/', function () {
    $articles = Article::published()->orderBy('updated_at', 'desc')->paginate(5);

    $topUsers = Article::
    published()
        ->limit(3)
        ->groupBy('user_id')
        ->orderByRaw('count(user_id) DESC')
        ->get();

    $bestUsers = [];

    return view('index', [
        'articles' => $articles,
        'topUsers' => $topUsers,
        'bestUsers' => $bestUsers
    ]);
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
Route::controller('course', CourseController::class);
Route::controller('user', UserController::class);
