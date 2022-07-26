<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Tcase;
use Illuminate\Support\Facades\Storage;

class tcaseController extends Controller
{

    private $fileExtension = '.pdf';

    public function index()
    {
        $collection = Tcase::where('username', Auth::user()->username)->get();
        return view('tcase.index', compact('collection'));
    }

    public function create()
    {
        return view('tcase.create');
    }

    public function store(Request $request)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        Tcase::create($data);
        return redirect()->route('tcase.index');
    }

    public function destroy($id)
    {
        $row = Tcase::where('id', $id)->firstOrFail();
        $oldIdentification = $row->identification;
        Storage::delete('public/tcase/' . $oldIdentification . $this->fileExtension);
        $row->delete();
        return redirect()->route('tcase.index');
    }

    public function edit($id)
    {
        $collection = Tcase::where('id', $id)->firstOrFail();
        $collection->startDate = str_replace('-', '/', $collection->startDate);
        $collection->endDate = str_replace('-', '/', $collection->endDate);
        return view('tcase.edit', compact('collection'));
    }

    public function show($id)
    {
        $collection = Tcase::where('id', $id)->firstOrFail();
        return view('tcase.show', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        $row = Tcase::where('id', $id)->firstOrFail();
        if (isset($data['identification'])) {
            $oldIdentification = $row->identification;
            Storage::delete('public/tcase/' . $oldIdentification . $this->fileExtension);
        }
        $row->update($data);
        return redirect()->route('tcase.index');
    }

    private function validation(Request $request)
    {
        $requestName = $request->route()->getName();
        $data = $request->validate([
            'projectName' => ['required', 'string', 'max:255'],
            'collaboration_name' => ['required', 'string', 'max:255'],
            'startDate' => ['required', 'date_format:Y/m/d'],
            'endDate' => ['required', 'date_format:Y/m/d'],
            'jobkind' => ['required', 'in:0,1'],
            'plantotal_money' => ['required', 'integer', 'max:9999999999'],
            'identification' => [Rule::requiredIf($requestName == 'other.store'), 'file', 'mimes:pdf'],
        ]);

        $jobkind = array('0' => '主持人', '1' => '共同主持人');
        $data['jobkind'] = $jobkind[$data['jobkind']];

        if (isset($data['identification'])) {
            $fileName = strtotime("now") . '.pdf';
            $request->file('identification')->storeAs('tcase', $fileName, 'public');
            $data['identification'] = $fileName;
        }

        return $data;
    }
}
