<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class generalInfoController extends Controller
{
    public function index()
    {
        return view('general_info.index');
    }

    public function create()
    {
        return view('general_info.create');
    }
}
