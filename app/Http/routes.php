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
    return view('welcome');
});

Route::get('/migrate/{id}', function(){
    Artisan::call('migrate');
})->where('id', 'lesna_jahoda');

Route::get('/seed/{id}', function(){
    Artisan::call('db:seed');
})->where('id', 'lesna_jahoda');

Route::get('/master', function () {
    return view('layouts.master');
});

Route::get('/skuska', function () {
    return view('layouts.skuska');
});

Route::controller('users', UserController::class);
