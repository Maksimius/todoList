<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoingsController extends Controller
{
    public function index()
    {
        return view('doingsMain');
    }
}
