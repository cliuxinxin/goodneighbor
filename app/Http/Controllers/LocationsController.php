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

    public function save()
    {
        return view('locations.save');
    }
}
