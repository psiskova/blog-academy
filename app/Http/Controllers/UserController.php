<?php

namespace App\Http\Controllers;

use Auth;
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
            'getGrading',
            'getManagement',
            'getBlock',
            'postManagement',
            'postBlock',
            'getUpdateProfile',
            'postUpdateProfile',
            'getProfileImage',
        ]]);

        $this->middleware('role:' . User::ADMIN_ROLE, ['only' => [
            'getManagement',
            'getBlock',
            'postManagement',
            'postBlock'
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
        $articles = $user->articles()->published()->get();

        return view('users.profile', [
            'user' => $user,
            'articles' => $articles
        ]);
    }

    /**
     * Responds to requests to GET /user/admin-profile
     */
    public function getAdminProfile() {

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
        $users = User::where('id', '<>', \Auth::id())
            ->orderBy('surname')
            ->orderBy('name')
            ->paginate(10, ['id', 'name', 'surname', 'role']);

        return view('users.management', [
            'users' => $users
        ]);
    }

    /**
     * Responds to request POST /user/management
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postManagement(Request $request) {
        $input = $request->all();
        User::find($input['id'])->update([
            'role' => $input['role']
        ]);

        return response()->json([
            'id' => $input['id'],
            'role' => $input['role']
        ]);
    }

    /**
     *Responds to request GET /user/block
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getBlock() {
        $users = User::where('id', '<>', \Auth::id())
            ->orderBy('surname')
            ->orderBy('name')
            ->paginate(10, ['id', 'name', 'surname', 'ban']);

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

        $user = User::findBySlugOrId($input['id']);

        $input = array_except($input, ['id']);

        $user->update($input);

        if ($request->ajax()) {

            return response()->json([
                'id' => $user->id,
                'ban' => $user->ban
            ]);
        } else {

            flash()->success('User updated');
            return redirect()->back();
        }
    }

    public function getGrading($id) {
        $user = User::findBySlugOrIdOrFail($id);

        return view('users.grading', [
            'user' => $user
        ]);
    }

    public function getUpdateProfile() {
        $user = Auth::user();

        return view('users.profileupdate', [
            'user' => $user
        ]);
    }

    public function postUpdateProfile(Request $request) {
        $input = $request->all();

        $user = Auth::user();

        if ($request->file('image')) {
            $file = $request->file('image');
            $photoName = uniqid() . '.' . $file->guessClientExtension();
            $file->move(storage_path(), $photoName);
            $user->profileimage = $photoName;
            $user->save();
        }

        $user->update($input);

        flash()->success('User updated');
        return redirect()->back();
    }

    public function getProfileImage($id) {
        $filePath = storage_path() . '/' . $id;

        return response()->download($filePath);
    }

}
