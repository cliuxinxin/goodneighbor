<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->only(['index']);
    }


    public function index()
    {
        $users = User::all();

//        $date_label = $users->lists('created_at');
//        $user_data =$users->lists('name');

        $date_label = ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"];
        $user_data = [12, 19, 3, 5, 2, 3];
        $tasks = Task::all();

        return view('admin.index',compact('users','tasks','date_label','user_data'));
    }

    public function test()
    {
        $users = User::all();

        $dates = $users->lists('created_at');
        $user =$users->lists('name');

        return [$dates,$user];
    }
}
