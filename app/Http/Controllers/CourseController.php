<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller {

    /**
     * Instantiate a new CourseController instance.
     *
     */
    public function __construct() {
        $this->middleware('auth');

        $this->middleware('role:' . User::TEACHER_ROLE, ['only' => [
            'getCreate',
            'postCreate',
            'postUpdateParticipant',
        ]]);

        $this->middleware('roles:' . User::STUDENT_ROLE . User::TEACHER_ROLE, ['only' => [
            'getOverview',
        ]]);
    }

    public function getOverview() {
        if (Auth::user()->hasRole(User::STUDENT_ROLE)) {
            $courses = Course::with([
                'teacher',
                'participants' => function ($query) {
                    $query->where('user_id', '=', Auth::id());
                }
            ])->orderBy('name')->get();

            return view('courses.student.overview', [
                'courses' => $courses
            ]);
        } else {
            $course = Auth::user()->course;
            if ($course) {
                $participants = $course->participants;
            } else {
                $participants = [];
            }

            return view('courses.teacher.overview', [
                'participants' => $participants
            ]);
        }
    }

    public function getCreate() {

        return view('courses.teacher.create');
    }

    public function postCreate(Request $request) {
        $input = $request->only(['year', 'name']);
        $input['user_id'] = Auth::id();
        Course::create($input);
        flash()->success('Kurz bol vytvorený');

        return redirect()->back();
    }

    public function postJoinCourse(Request $request) {
        if ($request->ajax()) {
            $input = $request->only(['course_id']);
            $input['state'] = Participant::PENDING;
            $input['user_id'] = Auth::id();

            Participant::create($input);

            return response()->json([
                'id' => $input['course_id']
            ]);
        }
    }

    public function postUpdateParticipant(Request $request) {
        if ($request->ajax()) {
            $input = $request->only(['user_id', 'state']);
            $input['course_id'] = Auth::user()->course->id;

            Participant::where('course_id', '=', $input['course_id'])->where('user_id', '=', $input['user_id'])->update($input);

            return response()->json([
                'id' => $input['user_id'],
                'value' => $input['state'] == Participant::REJECTED ? 'Odmietnutý' : 'Prihlásený'
            ]);
        }
    }

    public function postChangeSelectedCourse(Request $request) {
        Auth::user()->update($request->only(['course_id']));

        return redirect()->back();
    }
}
