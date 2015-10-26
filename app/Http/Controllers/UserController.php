<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller {

    /**
     * Instantiate a new UserController instance.
     *
     */
    public function __construct() {

        $this->middleware('guest');

        //  $this->middleware('role:admin', ['only' => 'getAdminProfile']);

        /*  $this->middleware('log', ['only' => ['fooAction', 'barAction']]);

          $this->middleware('subscribed', ['except' => ['fooAction', 'barAction']]);*/
    }

    /**
     * Responds to requests to GET /users
     */
    public function getIndex() {
        $u = User::create([
            'name' => 'stefan',
            'surname' => 'gerboc',
            'email' => 'ahoj@gmail.com',
            'password' => bcrypt('testik')
        ]);
        if ($u->save()) {
            dd('ok');
        }
        return view('users.index', [
            'users' => User::all(),
            'skuska' => 'ahoj'
        ]);
    }

    /**
     * Responds to requests to GET /users/profile/1 or /users/profile/name-lastname
     */
    public function getProfile($slug) {
        return view('users.show', [
            'user' => User::findBySlugOrIdOrFail($slug)
        ]);
    }

    /**
     * Responds to requests to GET /users/admin-profile
     */
    public function getAdminProfile() {
        return view('welcome');
    }

    /**
     * Responds to requests to POST /users/admin-profile
     * @param \Request $r
     * @return \Illuminate\View\View
     */
    public function postAdminProfile() {
        dd(\Input::all());
        return view('welcome');
    }

    /**
     * Responds to requests to POST /users/profile
     * @param \Request $r
     */
    public function postProfile(Request $r) {
        dd($r->all());
    }

}
