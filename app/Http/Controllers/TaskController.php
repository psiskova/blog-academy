<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Course;
use App\Http\Requests;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller {

    public function getCreate() {

        return view('tasks.create');
    }

    public function postCreate(Request $request) {
        $input = $request->only(['name']);
        $input['user_id'] = Auth::id();
        Task::create($input);
        flash()->message('Zadanie bolo vytvorené');

        return redirect()->back();
    }


}
