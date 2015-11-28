<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Discussion;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class DiscussionController extends Controller {

    public function __construct() {
        $this->middleware('auth');

        $this->middleware('roles:' . User::ADMIN_ROLE . User::TEACHER_ROLE, ['only' => [
            'getDelete',
        ]]);
    }

    public function postAddDiscussion(Request $request) {
        $input = $request->only(['text', 'parent', 'article_id']);
        if ($input['text'] == '') {
            if ($request->ajax()) {

                return response()->json();
            }

            return redirect()->back();
        }
        $input['article_id'] = Article::findBySlugOrId($input['article_id'])->id;
        $input['user_id'] = \Auth::id();

        $discussion = Discussion::create($input);

        if ($request->ajax()) {

            return response()->json($discussion);
        } else {

            return redirect()->back();
        }
    }

    public function getDelete(Request $request, $id) {
        $discussion = Discussion::find($id);
        Discussion::where('parent', '=', $id)->update([
            'parent' => $discussion->parent
        ]);

        $discussion->delete();

        return redirect()->back();
    }
}
