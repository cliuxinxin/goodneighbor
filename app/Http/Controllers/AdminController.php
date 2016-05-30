<?php

namespace App\Http\Controllers;

use App\EventRecord;
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
        $users_count = User::all()->count();

        $event_records = EventRecord::latest()->paginate(20);

        return view('admin.index',compact('users_count','event_records'));
    }

    public function test()
    {
        $users = User::all();

        $dates = $users->lists('created_at');
        $user =$users->lists('name');

        return [$dates,$user];
    }
}
