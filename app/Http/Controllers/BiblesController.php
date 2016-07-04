<?php

namespace App\Http\Controllers;

use App\Bible;
use Illuminate\Http\Request;

use App\Http\Requests;

class BiblesController extends Controller
{
    //
    public function get()
    {
        $bible = Bible::find(rand(1,200));

        return $bible;
    }
}
