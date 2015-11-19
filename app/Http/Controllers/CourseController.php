<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller {

    /**
     * Instantiate a new CourseController instance.
     *
     */
    public function __construct() {

    }

    public function getOverview() {
        $courses = Course::with([
            'teacher',
            'participants' => function ($query) {
                $query->where('user_id', '=', Auth::id());
            }
        ])->orderBy('name')->get();

        return view('courses.overview', [
            'courses' => $courses
        ]);
    }

    public function getCreate() {

        return view('courses.create');
    }

    public function postCreate(Request $request) {
        $input = $request->only(['year', 'name']);
        $input['user_id'] = Auth::id();
        Course::create($input);
        flash()->message('Kurz bol vytvorený');

        return redirect()->back();
    }

    public function postJoinCourse(Request $request) {
        if ($request->ajax()) {
            $input = $request->only(['course_id']);
            $input['state'] = Participant::JOINED;
            $input['user_id'] = Auth::id();

            Participant::create($input);

            return response()->json([
                'id' => $input['course_id']
            ]);
        }
    }
}
