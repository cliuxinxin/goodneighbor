<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Point;
use App\Task;
use App\Timeline;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;

class TimelinesController extends Controller
{

    protected $user;

    /**
     * Only auth user can see timelines.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['show']);
        $this->user = Auth::user();
    }


    /**
     * User timelines
     *
     * @return mixed
     */
    public function show()
    {
        $this->generate();

        $timelines = $this->user->timelines()->latest('time')->paginate(20);

        return view('timelines.show',compact('timelines'));
    }

    /**
     * Generate timeline
     * @return string
     */
    public function generate()
    {
        $this->userRegister();

        $this->userTask();

        $this->userComments();

        $this->userPoints();

        $users = User::all();

        foreach($users as $user){
            $comments = $user->comments;
            foreach ($comments as $comment) {
                $task_comments = $comment->task->comments;
                foreach($task_comments as $task_comment){
                    if($task_comment->user->id != $user->id && $comment->created_at <= $task_comment->created_at)
                    Timeline::firstOrCreate([
                        'user_id' => $user->id,
                        'task_id' => $task_comment->task->id,
                        'type' => '其他人评论',
                        'action' => $comment->content,
                        'time' => $task_comment->created_at
                    ]);
                }

            }

        }


        return "Generate Done";
    }

    /**
     * User Register
     */
    public function userRegister()
    {
        $users = User::all();

        foreach ($users as $user) {
            Timeline::firstOrCreate([
                'user_id' => $user->id,
                'type' => '注册',
                'time' => $user->created_at
            ]);
        }
    }

    /**
     * User send or recive a task
     */
    public function userTask()
    {
        $tasks = Task::all();

        $comments = Comment::all();

        foreach ($tasks as $task) {
            Timeline::firstOrCreate([
                'user_id' => $task->sender->id,
                'type' => '发布求助',
                'task_id' => $task->id,
                'time' => $task->created_at
            ]);

            if ($task->receiver) {
                Timeline::firstOrCreate([
                    'user_id' => $task->receiver->id,
                    'type' => '提供帮助',
                    'task_id' => $task->id,
                    'time' => $task->updated_at->addSecond()
                ]);
            }
        }
    }

    /**
     * User comments
     */
    public function userComments()
    {
        $comments = Comment::all();

        foreach ($comments as $comment) {
            if($comment->user->id != $comment->task->sender->id && $comment->task->reciever?$comment->user->id != $comment->task->reciever->id:1){
                Timeline::firstOrCreate([
                    'user_id' => $comment->user->id,
                    'type' => '评论',
                    'task_id' => $comment->task->id,
                    'action' => $comment->content,
                    'time' =>$comment->created_at
                ]);
            }

        }
    }

    /**
     * User get or spend points
     */
    public function userPoints()
    {
        $points = Point::all();

        foreach ($points as $point) {
            if ($point->details != '') {
                Timeline::firstOrCreate([
                    'user_id' => $point->reciever->id,
                    'type' => '注册获得积分',
                    'action' => $point->details.':'.$point->points,
                    'time' => $point->created_at->addSecond()
                ]);
            } elseif ($point->status == '') {
                Timeline::firstOrCreate([
                    'user_id' => $point->reciever->id,
                    'type' => '帮助获得积分',
                    'task_id' => $point->task->id,
                    'action' => $point->points,
                    'time' => $point->updated_at
                ]);

                Timeline::firstOrCreate([
                    'user_id' => $point->sender->id,
                    'type' => '求助花费积分',
                    'task_id' => $point->task->id,
                    'action' => $point->points,
                    'time' => $point->updated_at
                ]);
            }
        }
    }
}
