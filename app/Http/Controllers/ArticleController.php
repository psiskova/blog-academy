<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends Controller {

    public function getCreate() {

        return view('articles.create');
    }

    public function getDetail() {

        return view('articles.detail');
    }

    public function getManagement() {

        return view('articles.management');
    }
}
