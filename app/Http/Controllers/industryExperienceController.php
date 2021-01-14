<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $data = $this->validation($request);
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

    public function edit($username, $id)
    {
        $collection = DB::table('industry_experience')
            ->where('username', $username)
            ->where('id', $id)->first();

        return view('industry_experience.edit', compact('collection'));
    }

    public function update(Request $request, $username, $id)
    {
        $data = $this->validation($request);
        $data['updated_at'] = now();
        DB::table('industry_experience')->where('username', $username)->where('id', $id)->update($data);
        return redirect()->route('industry_experience.index');
    }

    private function validation(Request $request)
    {
        $requestName = $request->route()->getName();
        $data = $request->validate([
            'working_units' => ['required', 'string', 'max:100'],
            'position' => ['required', 'string', 'max:100'],
            'type' => ['required', 'in:專任,兼任'],
            'job_description' => ['required', 'string'],
            'startDate' => ['required', 'date_format:Y/m'],
            'endDate' => ['required', 'date_format:Y/m'],
            'identification' => [Rule::requiredIf($requestName == 'industry_experience.store'), 'file', 'mimes:pdf'],
        ]);

        $fileName = strtotime("now") . '.pdf';

        if (isset($data['identification'])) {
            $request->file('identification')->storeAs('industry_experience', $fileName, 'public');
            $data['identification'] = $fileName;
        }

        return $data;
    }
}
