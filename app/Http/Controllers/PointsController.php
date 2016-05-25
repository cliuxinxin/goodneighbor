<?php

namespace App\Http\Controllers;

use App\Point;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class PointsController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth')->only(['index']);
        $this->user = Auth::user();
    }

    public function index()
    {
//        $get_points = $this->user->getPoints();
        $get_points = Point::where('to_id',$this->user->id)->where('status',null)->paginate(10);
        $spend_points = Point::where('from_id',$this->user->id)->where('status',null)->paginate(10);

        $unconfirm_get_points = Point::where('to_id',$this->user->id)->where('status','在途')->paginate(10);
        $unconfirm_spend_points = Point::where('from_id',$this->user->id)->where('status','在途')->paginate(10);

        return view('points.index',compact('get_points','spend_points','unconfirm_get_points','unconfirm_spend_points'));
    }
}
