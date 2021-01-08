<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class thesisConfController extends Controller
{
    public function index()
    {
        $collection = DB::table('thesis_conf')->get();

        foreach ($collection as $item) {
            $item->corresponding_author == 0 ? $item->corresponding_author = '否' : $item->corresponding_author = '是';
        }
        return view('thesis_conf.index', compact('collection'));
    }

    public function create()
    {
        return view('thesis_conf.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'conf_name' => ['required', 'string', 'max:100'],
            'thesisName' => ['required', 'string', 'max:100'],
            'years' => ['required', 'date_format:Y'],
            'authorNo' => ['required', 'integer', 'min:1'],
            'corresponding_author' => ['required', 'in:0,1'],
            'country' => ['required', 'string', 'max:100'],
            'identification' => ['required', 'file', 'mimes:pdf']
        ]);

        $fileName = strtotime("now") . '.pdf';

        $request->file('identification')->storeAs('thesis_conf', $fileName, 'public');
        $data['identification'] = $fileName;

        $data['username'] = Auth::user()->username;
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('thesis_conf')->insert([$data]);
        return redirect()->route('thesis_conf.index');
    }

    public function destroy($id)
    {
        DB::table('thesis_conf')->where('id', $id)->delete();
        return redirect()->route('thesis_conf.index');
    }
}
