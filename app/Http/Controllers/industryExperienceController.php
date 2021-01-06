<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class industryExperienceController extends Controller
{
    public function index()
    {
        return view('industry_experience.index');
    }

    public function create()
    {
        return view('industry_experience.create');
    }
}
