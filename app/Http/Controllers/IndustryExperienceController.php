<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Industry_experience;
use Illuminate\Support\Facades\Storage;

class IndustryExperienceController extends Controller
{
    private $fileExtension = '.pdf';
    private $methodMappingTable = array(
        'index' => 'viewAny',
        'show' => 'view',
        'create' => 'create',
        'store' => 'create',
        'edit' => 'update',
        'update' => 'update',
        'destroy' => 'delete',
    );

    public function index()
    {
        $this->authorize($this->methodMappingTable['index'], Industry_experience::class);
        $collection = Industry_experience::where('username', Auth::user()->username)->get();
        return view('industry_experience.index', compact('collection'));
    }

    public function create()
    {
        $this->authorize($this->methodMappingTable['create'], Industry_experience::class);
        return view('industry_experience.create');
    }

    public function store(Request $request)
    {
        $this->authorize($this->methodMappingTable['store'], Industry_experience::class);
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        Industry_experience::create($data);
        return redirect()->route('industry_experience.index');
    }

    public function destroy(Industry_experience $industry_experience)
    {
        $this->authorize($this->methodMappingTable['destroy'], $industry_experience);
        $oldIdentification = $industry_experience->identification;
        Storage::delete('public/industry_experience/' . $oldIdentification . $this->fileExtension);
        $industry_experience->delete();
        return redirect()->route('industry_experience.index');
    }

    public function edit(Industry_experience $industry_experience)
    {
        $this->authorize($this->methodMappingTable['edit'], $industry_experience);
        return view('industry_experience.edit', compact('industry_experience'));
    }

    public function show(Industry_experience $industry_experience)
    {
        $this->authorize($this->methodMappingTable['show'], $industry_experience);
        return view('industry_experience.show', compact('industry_experience'));
    }

    public function update(Request $request, Industry_experience $industry_experience)
    {
        $this->authorize($this->methodMappingTable['update'], $industry_experience);
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        if (isset($data['identification'])) {
            $oldIdentification = $industry_experience->identification;
            Storage::delete('public/industry_experience/' . $oldIdentification . $this->fileExtension);
        }
        $industry_experience->update($data);
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
