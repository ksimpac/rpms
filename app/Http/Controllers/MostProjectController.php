<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Most_project;
use Illuminate\Support\Facades\Storage;

class MostProjectController extends Controller
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
        $this->authorize($this->methodMappingTable['index'], Most_project::class);
        $collection = Most_project::where('username', Auth::user()->username)->get();
        return view('most_project.index', compact('collection'));
    }

    public function create()
    {
        $this->authorize($this->methodMappingTable['create'], Most_project::class);
        return view('most_project.create');
    }

    public function store(Request $request)
    {
        $this->authorize($this->methodMappingTable['store'], Most_project::class);
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        Most_project::create($data);
        return redirect()->route('most_project.index');
    }

    public function destroy(Most_project $most_project)
    {
        $this->authorize($this->methodMappingTable['destroy'], $most_project);
        $oldIdentification = $most_project->identification;
        Storage::delete('public/most_project/' . $oldIdentification . $this->fileExtension);
        $most_project->delete();
        return redirect()->route('most_project.index');
    }

    public function edit(Most_project $most_project)
    {
        $this->authorize($this->methodMappingTable['edit'], $most_project);
        $most_project->startDate = str_replace('-', '/', $most_project->startDate);
        $most_project->endDate = str_replace('-', '/', $most_project->endDate);
        return view('most_project.edit', compact('most_project'));
    }

    public function show(Most_project $most_project)
    {
        $this->authorize($this->methodMappingTable['show'], $most_project);
        return view('most_project.show', compact('most_project'));
    }

    public function update(Request $request, Most_project $most_project)
    {
        $this->authorize($this->methodMappingTable['update'], $most_project);
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        if (isset($data['identification'])) {
            $oldIdentification = $most_project->identification;
            Storage::delete('public/most_project/' . $oldIdentification . $this->fileExtension);
        }
        $most_project->update($data);
        return redirect()->route('most_project.index');
    }

    private function validation(Request $request)
    {
        $requestName = $request->route()->getName();
        $data = $request->validate([
            'projectName' => ['required', 'string', 'max:255'],
            'startDate' => ['required', 'date_format:Y/m/d', 'after_or_equal:' . date("Y/m/d", strtotime("-5 years"))],
            'endDate' => ['required', 'date_format:Y/m/d', 'after:startDate', 'before_or_equal:' . date("Y/m/d", strtotime("now"))],
            'jobkind' => ['required', 'in:0,1'],
            'plantotal_money' => ['required', 'integer', 'max:9999999999'],
            'identification' => [Rule::requiredIf($requestName == 'most_project.store'), 'file', 'mimes:pdf'],
        ]);

        $jobkind = array('0' => '主持人', '1' => '共同主持人');
        $data['jobkind'] = $jobkind[$data['jobkind']];

        if (isset($data['identification'])) {
            $fileName = strtotime("now") . '.pdf';
            $request->file('identification')->storeAs('most_project', $fileName, 'public');
            $data['identification'] = $fileName;
        }

        return $data;
    }
}
