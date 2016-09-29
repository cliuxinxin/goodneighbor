<?php

namespace App\Http\Controllers;


use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;

class ThingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = Auth::user();
    }


    public function get()
    {
        return view('things.index');
    }

    public function store(Request $request)
    {
        $this->user->thing()->create($request->all());

        return 'ok';
    }
}
