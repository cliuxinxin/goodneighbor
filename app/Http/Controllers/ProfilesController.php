<?php

namespace App\Http\Controllers;

use App\Garden;
use App\Profile;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProfilesController extends Controller
{
    protected $user;


    public function __construct()
    {
        $this->middleware('auth')->only(['index','edit','update']);
        $this->user = Auth::user();
    }

    /**
     * Display user own profile.
     *
     * @param $userid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($userid)
    {

        $profile = $this->user->profile()->firstOrCreate([]);

        return view('profile.index',compact('profile'));
    }

    /**
     * User edit his profile
     *
     * @param $userid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($userid)
    {
        $profile = $this->user->profile;

        $gardens = Garden::orderBy('city')->get();

        $gardens = $gardens->lists('CityGarden','id');

//        dd($gardens);

        return view('profile.edit',compact('profile','gardens'));

    }

    /**
     *
     * Update User profile after edit
     *
     * @param $profile_id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($profile_id,Request $request)
    {

        Profile::find($profile_id)->update($request->all());

        return redirect()->action('ProfilesController@index', ['userid' => $this->user->id]);
    }
}
