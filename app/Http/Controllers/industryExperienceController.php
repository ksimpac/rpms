<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Industry_experience;
use Illuminate\Support\Facades\Storage;

class industryExperienceController extends Controller
{

    private $fileExtension = '.pdf';

    public function index()
    {
        $collection = Industry_experience::where('username', Auth::user()->username)->get();
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
        Industry_experience::create($data);
        return redirect()->route('industry_experience.index');
    }

    public function destroy($id)
    {
        $row = Industry_experience::where('id', $id)->firstOrFail();
        $oldIdentification = $row->identification;
        Storage::delete('public/industry_experience/' . $oldIdentification . $this->fileExtension);
        $row->delete();
        return redirect()->route('industry_experience.index');
    }

    public function edit($id)
    {
        $collection = Industry_experience::where('id', $id)->firstOrFail();
        return view('industry_experience.edit', compact('collection'));
    }

    public function show($id)
    {
        $collection = Industry_experience::where('id', $id)->firstOrFail();
        return view('industry_experience.show', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        $row = Industry_experience::where('id', $id);
        if (isset($data['identification'])) {
            $oldIdentification = $row->identification;
            Storage::delete('public/industry_experience/' . $oldIdentification . $this->fileExtension);
        }
        $row->update($data);
        return redirect()->route('industry_experience.index');
    }

    private function validation(Request $request)
    {
        $requestName = $request->route()->getName();
        $data = $request->validate([
            'working_units' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:part-time,full-time'],
            'job_description' => ['required', 'string'],
            'startDate' => ['required', 'date_format:Y/m'],
            'endDate' => ['required', 'date_format:Y/m', 'after:startDate'],
            'identification' => [Rule::requiredIf($requestName == 'industry_experience.store'), 'file', 'mimes:pdf'],
        ]);

        $type = array('part-time' => '兼任', 'full-time' => '專任');
        $data['type'] = $type[$data['type']];

        $fileName = strtotime("now") . '.pdf';

        if (isset($data['identification'])) {
            $request->file('identification')->storeAs('industry_experience', $fileName, 'public');
            $data['identification'] = $fileName;
        }

        return $data;
    }
}
