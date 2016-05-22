<?php

namespace App\Http\Controllers;

use App\Comment;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentsController extends Controller
{
    /**
     * User only login can comment
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }


    public function store($task,Request $request)
    {

        $input = $request->all();

        $input['user_id'] = Auth::user()->id;

        $input['task_id'] = $task->id;

        Comment::create($input);

        return redirect()->action('TasksController@show', ['tasks' => $task->id]);
    }
}
