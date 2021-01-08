<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class educationController extends Controller
{
    public function index()
    {
        $collection = DB::table('education')->get();
        return view('education.index', compact('collection'));
    }

    public function create()
    {
        return view('education.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'schoolName' => ['required', 'string', 'max:100'],
            'department' => ['required', 'string', 'max:100'],
            'startDate' => ['required', 'date_format:Y/m'],
            'endDate' => ['required', 'date_format:Y/m'],
            'degree' => ['in:大學,碩士,博士'],
            'status' => ['in:畢業,結業,肆業'],
            'country' => ['required', 'string', 'max:100'],
            'thesis' => $request->input('degree') != '大學' ? ['required', 'string', 'max:100'] : ['string', 'max:100'],
            'advisor' => $request->input('degree') != '大學' ? ['required', 'string', 'max:100'] : ['string', 'max:100'],
            'certificate' => ['required', 'file', 'mimes:pdf'],
            'transcript' => ['file', 'mimes:pdf']
        ]);

        $fileName = strtotime("now") . '.pdf';

        if ($data['transcript'] != null) {
            $request->file('transcript')->storeAs('education\transcript', $fileName, 'public');
            $data['transcript'] = $fileName;
        }

        $request->file('certificate')->storeAs('education\certificate', $fileName, 'public');
        $data['certificate'] = $fileName;

        $data['username'] = Auth::user()->username;
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('education')->insert([$data]);
        return redirect()->route('education.index');
    }

    public function destroy($username)
    {
        DB::table('general_info')->where('username', $username)->delete();
        return redirect()->route('education.index');
    }
}
