<?php

namespace App\Http\Controllers;

use App\EventRecord;
use App\Garden;
use App\Task;
use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->only(['index','gardens','gardensDelete','gardensStore']);
    }


    /**
     * Over all review
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users_count = User::all()->count();

        $event_records = EventRecord::latest()->paginate(20);

        return view('admin.index',compact('users_count','event_records'));
    }

    /**
     * View all the gardens
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gardens()
    {
        $gardens = Garden::all();

        return view('admin.gardens',compact('gardens'));
    }

    /**
     * Create gardens
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gardensCreate()
    {
        return view('admin.gardensCreate');
    }

    /**
     *
     * Store gardens.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function gardensStore(Request $request)
    {
        Garden::create($request->all());

        return redirect('admin/gardens');
    }

    /**
     * Delete the gardens
     *
     * @param $gardens
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function gardensDelete($gardens)
    {
        $garden = Garden::findOrFail($gardens);

        $garden->delete();

        return redirect('admin/gardens');
    }

    public function test()
    {
        $users = User::all();

        $dates = $users->lists('created_at');
        $user =$users->lists('name');

        return [$dates,$user];
    }
}
