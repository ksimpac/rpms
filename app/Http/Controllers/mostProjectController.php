<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mostProjectController extends Controller
{
    public function index()
    {
        return view('MOST_project.index');
    }

    public function create()
    {
        return view('MOST_project.create');
    }
}
