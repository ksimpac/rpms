<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class thesisController extends Controller
{
    public function index()
    {
        return view('thesis.index');
    }

    public function create()
    {
        return view('thesis.create');
    }
}
