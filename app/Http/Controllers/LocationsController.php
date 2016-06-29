<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LocationsController extends Controller
{
    //

    public function get()
    {
        return view('locations.get');
    }

    public function save(Request $request)
    {
        return $request->all();
//        return view('locations.save');
    }
}
