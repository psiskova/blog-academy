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

        $this->middleware('guest', ['except' => ['getProfile']]);

        //  $this->middleware('role:admin', ['only' => 'getAdminProfile']);

        /*  $this->middleware('log', ['only' => ['fooAction', 'barAction']]);

          $this->middleware('subscribed', ['except' => ['fooAction', 'barAction']]);*/
    }

    /**
     * Responds to requests to GET /user
     */
    public function getIndex() {

        return view('users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Responds to requests to GET /user/profile/1 or /user/profile/name-lastname
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfile($id) {
        $user = User::findBySlugOrIdOrFail($id);

        return view('users.profile', [
            'user' => $user
        ]);
    }

    /**
     * Responds to requests to GET /user/admin-profile
     */
    public function getAdminProfile() {
        return view('welcome');
    }

    /**
     * Responds to requests to POST /user/admin-profile
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postAdminProfile() {
        dd(\Input::all());
        return view('welcome');
    }

    /**
     * Responds to requests to POST /user/profile
     * @param Request $r
     */
    public function postProfile(Request $r) {
        dd($r->all());
    }

}
