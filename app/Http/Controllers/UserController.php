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

        $this->middleware('guest', ['except' => [
            'getProfile',
            'getManagement',
            'getBlock'
        ]]);

        $this->middleware('role:admin', ['only' => [
            'getManagement',
            'getBlock'
        ]]);

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
     *
     * @param Request $r
     */
    public function postProfile(Request $r) {
        dd($r->all());
    }

    /**
     * Responds to request GET /user/management
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getManagement() {

        return view('users.management');
    }

    /**
     * Responds to request POST /user/management
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postManagement(Request $request) {
        $input = $request->all();

        if ($request->ajax()) {

        } else {

            return redirect()->back();
        }
    }

    /**
     *Responds to request GET /user/block
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getBlock() {
        $users = User::where('id', '<>', \Auth::id())->get(['name', 'surname', 'ban']);

        return view('users.block', [
            'users' => $users
        ]);
    }

    /**
     * Responds to request POST /user/block
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postBlock(Request $request) {
        $input = $request->all();

        if ($request->ajax()) {

        } else {

            return redirect()->back();
        }
    }

}
