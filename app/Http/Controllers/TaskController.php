<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller {

    public function __construct() {

        $this->middleware('auth');
        $this->middleware('roles:' . User::ADMIN_ROLE . User::TEACHER_ROLE);
    }

    public function getCreate() {

        return view('tasks.create');
    }

    public function postCreate(Request $request) {
        $input = $request->only(['name']);
        $input['user_id'] = Auth::id();
        $input['course_id'] = Auth::user()->course_id;
        Task::create($input);
        flash()->message('Zadanie bolo vytvorené');

        return redirect()->back();
    }


}
