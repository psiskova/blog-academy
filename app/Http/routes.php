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

Route::get('/', function () {
    return view('index');
});

Route::get('/migrate/{id}', function(){
    Artisan::call('migrate');
})->where('id', 'lesna_jahoda');

Route::get('/seed/{id}', function(){
    Artisan::call('db:seed');
})->where('id', 'lesna_jahoda');


Route::get('/article/create', function () {
    return view('articles.create');
});

Route::get('/article/detail', function () {
    return view('articles.detail');
});

Route::get('/article/management', function () {
    return view('articles.management');
});

Route::get('/course/overview', function () {
    return view('courses.overview');
});

Route::controller('users', UserController::class);
