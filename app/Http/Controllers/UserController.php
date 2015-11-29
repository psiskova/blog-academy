<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Auth;
use DB;
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

        $this->middleware('roles:' . User::TEACHER_ROLE . User::STUDENT_ROLE, ['only' => [
            'getGrading'
        ]]);
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
        $articles = $user->articles()->published()->orderBy('updated_at', 'DESC')->get();

        return view('users.profile', [
            'user' => $user,
            'articles' => $articles
        ]);
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

            flash()->success('Užívateľ bol upravený');
            return redirect()->back();
        }
    }

    public function getGrading($id) {
        $user = User::findBySlugOrIdOrFail($id);
        $course = $user->course;
        if ($course) {
            $course_id = $course->id;

            if ($user->hasRole(User::STUDENT_ROLE)) {

                $unratedArticles = $user->articles()->published()->unrated($course_id)->get();
                $ratedArticles = $user->articles()->published()->rated($course_id)->get();
            } else {

                $unratedArticles = Article::published()->unrated($course_id)->get();

                $ratedArticles = DB::select(DB::raw('
                    select
                      *
                    from (
                        select
                            users.id as user_id,
                            avg(ratings.rating) as rating
                        from
                            articles,
                            participants,
                            courses,
                            tasks,
                            ratings,
                            users
                        where
                            users.id = articles.user_id and
                            courses.id = ' . $course_id . ' and
                            tasks.course_id = courses.id and
		                    participants.user_id = users.id and
                            participants.course_id = courses.id and
                            articles.task_id = tasks.id and
                            ratings.text <> \'\' and
                            ratings.article_id = articles.id
                        having
                            avg(ratings.rating) > 0
                        union
                            select
                              participants.user_id as user_id,
                              0 as rating
                            from
                              participants
                            where
                              participants.course_id =  ' . $course_id . ' and
                              participants.state = 2
                    ) t
                    group by
                      user_id'));
            }
        } else {
            $unratedArticles = [];
            $ratedArticles = [];
        }

        return view('users.grading', [
            'user' => $user,
            'unratedArticles' => $unratedArticles,
            'ratedArticles' => $ratedArticles
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

        flash()->success('Profil úspešne uložený');
        return redirect()->action('UserController@getProfile', ['id' => $user->slug]);
    }

    public function getProfileImage($id) {
        $filePath = storage_path() . '/' . $id;

        return response()->download($filePath);
    }

}
