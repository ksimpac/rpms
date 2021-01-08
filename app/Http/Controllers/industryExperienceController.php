<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class industryExperienceController extends Controller
{
    public function index()
    {
        $username = Auth::user()->username;
        $collection = DB::table('industry_experience')->where('username', $username)->get();
        return view('industry_experience.index', compact('collection'));
    }

    public function create()
    {
        return view('industry_experience.create');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'working_units' => ['required', 'string', 'max:100'],
            'position' => ['required', 'string', 'max:100'],
            'type' => ['required', 'in:專任,兼任'],
            'job_description' => ['required', 'string'],
            'startDate' => ['required', 'date_format:Y/m'],
            'endDate' => ['required', 'date_format:Y/m'],
            'identification' => ['required', 'file', 'mimes:pdf'],
        ]);

        $fileName = strtotime("now") . '.pdf';

        $request->file('identification')->storeAs('industry_experience', $fileName, 'public');
        $data['identification'] = $fileName;

        $data['username'] = Auth::user()->username;
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('industry_experience')->insert([$data]);
        return redirect()->route('industry_experience.index');
    }

    public function destroy($id)
    {
        DB::table('industry_experience')->where('id', $id)->delete();
        return redirect()->route('industry_experience.index');
    }
}
