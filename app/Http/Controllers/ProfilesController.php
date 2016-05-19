<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProfilesController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth')->only(['index']);
        $this->user = Auth::user();
    }

    public function index($userid)
    {
        $profile = $this->user->profile;

        return view('profile.index',compact('profile'));
    }
}
