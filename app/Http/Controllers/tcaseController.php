<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tcaseController extends Controller
{
    public function index()
    {
        return view('tcase.index');
    }

    public function create()
    {
        return view('tcase.create');
    }
}
