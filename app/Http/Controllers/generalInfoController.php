<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class generalInfoController extends Controller
{
    public function index()
    {
        $username = Auth::user()->username;
        $collection = DB::table('general_info')->where('username', $username)->get();

        foreach ($collection as $item) {
            $item->sex == 0 ? $item->gender = '女' : $item->gender = '男';
        }
        return view('general_info.index', compact('collection'));
    }

    public function create()
    {
        return view('general_info.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'englishLastName' => ['required', 'string', 'max:100'],
            'englishFirstName' => ['required', 'string', 'max:100'],
            'birthday' => ['required', 'date_format:Y/m/d'],
            'sex' => ['required', 'in:0,1'],
            'telephone' => ['required', 'string', 'min:10', 'max:10'],
            'Permanent_Address' => ['required', 'string', 'max:100'],
            'Residential_Address' => ['required', 'string', 'max:100'],
            'teacherCertificateFiles' => $request->input('teacherCertificateType') !== "無" ? ['required', 'file', 'mimes:pdf'] : [],
            'working_units' => ['required', 'string', 'max:100'],
            'position' => ['required', 'string', 'max:100'],
            'startDate' => ['required', 'date_format:Y/m'],
            'course' => ['required', 'string'],
        ]);

        $fileName = strtotime("now") . '.pdf';

        if (isset($data['teacherCertificateFiles'])) {
            $request->file('teacherCertificateFiles')->storeAs('general_info', $fileName, 'public');
            $data['teacherCertificateFiles'] = $fileName;
        }

        $data['username'] = Auth::user()->username;
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('general_info')->insert([$data]);
        return redirect()->route('general_info.index');
    }

    public function destroy($username)
    {
        DB::table('general_info')->where('username', $username)->delete();
        return redirect()->route('general_info.index');
    }
}
