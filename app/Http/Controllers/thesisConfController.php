<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class thesisConfController extends Controller
{
    public function index()
    {
        return view('thesis_conf.index');
    }

    public function create()
    {
        return view('thesis_conf.create');
    }
}
