<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class otherController extends Controller
{
    public function index()
    {
        return view('other.index');
    }

    public function create()
    {
        return view('other.create');
    }
}
