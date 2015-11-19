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
            if ($course = Auth::user()->course) {
                $participants = $course->participants;

                return view('courses.teacher.overview', [
                    'participants' => $participants
                ]);
            } else {

                return view('courses.teacher.overview', [
                    'course' => false
                ]);
            }
        }
    }

    public function getCreate() {

        return view('courses.teacher.create');
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

    public function postChangeSelectedCourse(Request $request) {
        Auth::user()->update($request->only(['course_id']));

        return redirect()->back();
    }
}
