<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class thesisController extends Controller
{
    public function index()
    {
        $username = Auth::user()->username;
        $collection = DB::table('thesis')->where('username', $username)->get();

        foreach ($collection as $item) {
            $item->corresponding_author == 0 ? $item->corresponding_author = '否' : $item->corresponding_author = '是';
        }
        return view('thesis.index', compact('collection'));
    }

    public function create()
    {
        return view('thesis.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'publicationName' => ['required', 'string', 'max:100'],
            'publicationDate' => ['required', 'date_format:Y/m'],
            'authorNo' => ['required', 'integer', 'min:1'],
            'order' => ['required', 'integer', 'min:1'],
            'corresponding_author' => ['required', 'in:0,1'],
            'thesisName' => ['required', 'string', 'max:100'],
            'type' => ['required', 'in:SCI,SCIE,SSCI,其他'],
            'identification' => ['required', 'file', 'mimes:pdf'],
        ]);

        $fileName = strtotime("now") . '.pdf';

        $request->file('identification')->storeAs('thesis', $fileName, 'public');
        $data['identification'] = $fileName;

        $data['username'] = Auth::user()->username;
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('thesis')->insert([$data]);
        return redirect()->route('thesis.index');
    }

    public function destroy($id)
    {
        DB::table('thesis')->where('id', $id)->delete();
        return redirect()->route('thesis.index');
    }
}
