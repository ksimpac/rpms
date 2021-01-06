<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class educationController extends Controller
{
    public function index()
    {
        return view('education.index');
    }

    public function create()
    {
        return view('education.create');
    }
}
