<?php

namespace App\Http\Controllers;


use App\Http\Requests\TaskRequest;
use App\Http\Requests;
use App\Task;
use Auth;

class TasksController extends Controller
{
    protected $user;

    /**
     * Only auth user can create a task.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['create']);
        $this->user = Auth::user();
    }

    //TODO:list all the task.
    public function index()
    {
        $tasks = Task::latest('created_at')->get();

        return view('tasks.index',compact('tasks'));
    }

    /**
     * User can post a task
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('tasks.create');
    }


    /**
     *
     * Store the task send by a user
     *
     * @param TaskRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TaskRequest $request)
    {
        $this->user->sendTasks()->create($request->all());

        return redirect('tasks');
    }

    public function destroy($task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('tasks');
    }
}
