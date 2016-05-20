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
        $this->middleware('auth')->only(['index','edit','update','inviteCode']);
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
        $input = $request->all();

        $profile = Profile::find($profile_id);

        $this->getBouns($profile, $input);

        return redirect()->action('ProfilesController@index', ['userid' => $this->user->id]);
    }


    /**
     * User generate the invite code.
     *
     * @param $profileId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function inviteCode($profileId)
    {
        Profile::find($profileId)->update(['invite_code'=> '']);

        return redirect()->action('ProfilesController@index', ['userid' => $this->user->id]);
    }

    /**
     * @param $profile
     * @param $input
     */
    public function getBouns($profile, $input)
    {
        if ($profile->isCanGetBouns($input['bonus_code'])) {

            $invite_user = $profile->inviter($input['bonus_code']);

            $this->user->toPoints()->create([
                'to_id' => $this->user->id,
                'points' => 50000,
                'details' => '被' . $invite_user->name . '邀请注册送积分'
            ]);

            $invite_user->toPoints()->create([
                'to_id' => $invite_user->id,
                'points' => 50000,
                'details' => '邀请' . $this->user->name . '注册送积分'
            ]);

            $input['bonus_status'] = "已被邀请";
        }

        $profile->update($input);
    }

}
