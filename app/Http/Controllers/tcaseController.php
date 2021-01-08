<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class tcaseController extends Controller
{
    public function index()
    {
        $collection = DB::table('tcase')->get();
        return view('tcase.index', compact('collection'));
    }

    public function create()
    {
        return view('tcase.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'projectName' => ['required', 'string', 'max:100'],
            'collaboration_name' => ['required', 'string', 'max:100'],
            'startDate' => ['required', 'date_format:Y/m/d'],
            'endDate' => ['required', 'date_format:Y/m/d'],
            'jobkind' => ['required', Rule::in(['主持人', '共同主持人'])],
            'plantotal_money' => ['required', 'integer', 'max:9999999999'],
            'identification' => ['required', 'file', 'mimes:pdf'],
        ]);

        $fileName = strtotime("now") . '.pdf';

        $request->file('identification')->storeAs('tcase', $fileName, 'public');
        $data['identification'] = $fileName;

        $data['username'] = Auth::user()->username;
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('tcase')->insert([$data]);
        return redirect()->route('tcase.index');
    }

    public function destroy($id)
    {
        DB::table('tcase')->where('id', $id)->delete();
        return redirect()->route('tcase.index');
    }
}
