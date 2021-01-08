<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class otherController extends Controller
{
    public function index()
    {
        $username = Auth::user()->username;
        $collection = DB::table('other')->where('username', $username)->get();
        return view('other.index', compact('collection'));
    }

    public function create()
    {
        return view('other.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'identification' => ['required', 'file', 'mimes:pdf'],
        ]);

        $fileName = strtotime("now") . '.pdf';

        $request->file('identification')->storeAs('other', $fileName, 'public');
        $data['identification'] = $fileName;

        $data['username'] = Auth::user()->username;
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('other')->insert([$data]);
        return redirect()->route('other.index');
    }

    public function destroy($id)
    {
        DB::table('other')->where('id', $id)->delete();
        return redirect()->route('other.index');
    }
}
