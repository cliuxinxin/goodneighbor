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
        $this->middleware('auth')->only(['create','take','store']);
        $this->user = Auth::user();
    }


    /**
     * List all the tasks
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tasks = Task::latest('created_at')->get();

        return view('tasks.index',compact('tasks'));
    }

    /**
     * User take the task
     *
     * @param $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function take($task)
    {

        $this->authorize('receiver', $task);

        $task->update(['receiver_id' => $this->user->id]);

        return redirect('tasks');

    }

    /**
     * Sender confirm the receiver get done the job
     *
     * @param $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirm($task)
    {
        $task->update(['status' =>'完成' ]);

        return redirect('tasks');
    }

    /**
     * Sender can remove the receiver
     *
     * @param $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function remove($task)
    {
        $task->update(['receiver_id' => null ]);

        return redirect('tasks');
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

    /**
     * Delete the tasks send by the user
     *
     * @param $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('tasks');
    }
}
