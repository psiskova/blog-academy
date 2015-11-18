<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests;
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
        $courses = Course::with('teacher')->get();

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

}
