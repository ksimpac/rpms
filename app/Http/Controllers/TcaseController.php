<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Tcase;
use Illuminate\Support\Facades\Storage;

class TcaseController extends Controller
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
        $this->authorize($this->methodMappingTable['index'], Tcase::class);
        $collection = Tcase::where('username', Auth::user()->username)->get();
        return view('tcase.index', compact('collection'));
    }

    public function create()
    {
        $this->authorize($this->methodMappingTable['create'], Tcase::class);
        return view('tcase.create');
    }

    public function store(Request $request)
    {
        $this->authorize($this->methodMappingTable['store'], Tcase::class);
        $data = $this->validation($request);
        $data = $this->removeAsciiControlCharacter($data);
        $data['username'] = Auth::user()->username;
        Tcase::create($data);
        return redirect()->route('tcase.index');
    }

    public function destroy(Tcase $tcase)
    {
        $this->authorize($this->methodMappingTable['destroy'], $tcase);
        $oldIdentification = $tcase->identification;
        Storage::delete('public/tcase/' . $oldIdentification . $this->fileExtension);
        $tcase->delete();
        return redirect()->route('tcase.index');
    }

    public function edit(Tcase $tcase)
    {
        $this->authorize($this->methodMappingTable['edit'], $tcase);
        $tcase->startDate = str_replace('-', '/', $tcase->startDate);
        $tcase->endDate = str_replace('-', '/', $tcase->endDate);
        return view('tcase.edit', compact('tcase'));
    }

    public function show(Tcase $tcase)
    {
        $this->authorize($this->methodMappingTable['show'], $tcase);
        return view('tcase.show', compact('tcase'));
    }

    public function update(Request $request, Tcase $tcase)
    {
        $this->authorize($this->methodMappingTable['update'], $tcase);
        $data = $this->validation($request);
        $data = $this->removeAsciiControlCharacter($data);
        $data['username'] = Auth::user()->username;
        if (isset($data['identification'])) {
            $oldIdentification = $tcase->identification;
            Storage::delete('public/tcase/' . $oldIdentification . $this->fileExtension);
        }
        $tcase->update($data);
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

    private function removeAsciiControlCharacter($data)
    {
        $stringColumns = ['projectName', 'collaboration_name'];
        foreach ($stringColumns as $column) {
            preg_replace_array('/[\x00-\x1F\x7F]/', [''], $data[$column]);
        }
        return $data;
    }
}
