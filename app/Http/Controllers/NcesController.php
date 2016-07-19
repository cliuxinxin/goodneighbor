<?php

namespace App\Http\Controllers;

use App\Nce;
use Illuminate\Http\Request;

use App\Http\Requests;

class NcesController extends Controller
{
    //
    public function get()
    {
        $nce = Nce::find(rand(1,5865));

        return $nce;
    }
}
