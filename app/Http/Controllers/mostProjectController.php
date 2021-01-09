<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class mostProjectController extends Controller
{
    public function index()
    {
        $username = Auth::user()->username;
        $collection = DB::table('MOST_project')->where('username', $username)->get();
        return view('MOST_project.index', compact('collection'));
    }

    public function create()
    {
        return view('MOST_project.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'projectName' => ['required', 'string', 'max:100'],
            'startDate' => ['required', 'date_format:Y/m/d'],
            'endDate' => ['required', 'date_format:Y/m/d'],
            'jobkind' => ['required', Rule::in(['主持人', '共同主持人'])],
            'plantotal_money' => ['required', 'integer', 'max:9999999999'],
            'identification' => ['required', 'file', 'mimes:pdf'],
        ]);

        $fileName = strtotime("now") . '.pdf';

        $request->file('identification')->storeAs('MOST_project', $fileName, 'public');
        $data['identification'] = $fileName;

        $data['username'] = Auth::user()->username;
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('MOST_project')->insert([$data]);
        return redirect()->route('MOST_project.index');
    }

    public function destroy($id)
    {
        DB::table('MOST_project')->where('id', $id)->delete();
        return redirect()->route('MOST_project.index');
    }
}
