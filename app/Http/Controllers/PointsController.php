<?php

namespace App\Http\Controllers;

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
        $get_points = $this->user->getPoints();
        $spend_points = $this->user->spendPoints();

        $unconfirm_get_points = $this->user->unConfirmGetPoints();
        $unconfirm_spend_points = $this->user->unConfirmSpendPoints();

        return view('points.index',compact('get_points','spend_points','unconfirm_get_points','unconfirm_spend_points'));
    }
}
