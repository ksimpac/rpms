<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Thesis;
use Illuminate\Support\Facades\Storage;

class ThesisController extends Controller
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
        $this->authorize($this->methodMappingTable['index'], Thesis::class);
        $collection = Thesis::where('username', Auth::user()->username)->get();

        foreach ($collection as $item) {
            $item->corresponding_author == 0 ? $item->corresponding_author = '否' : $item->corresponding_author = '是';
        }

        return view('thesis.index', compact('collection'));
    }

    public function create()
    {
        $this->authorize($this->methodMappingTable['create'], Thesis::class);
        return view('thesis.create');
    }

    public function store(Request $request)
    {
        $this->authorize($this->methodMappingTable['store'], Thesis::class);
        $data = $this->validation($request);
        $data = $this->removeAsciiControlCharacter($data);
        $data['username'] = Auth::user()->username;
        Thesis::create($data);
        return redirect()->route('thesis.index');
    }

    public function destroy(Thesis $thesis)
    {
        $this->authorize($this->methodMappingTable['destroy'], $thesis);
        $oldIdentification = $thesis->identification;
        Storage::delete('public/thesis/' . $oldIdentification . $this->fileExtension);
        $thesis->delete();
        return redirect()->route('thesis.index');
    }

    public function edit(Thesis $thesis)
    {
        $this->authorize($this->methodMappingTable['edit'], $thesis);
        return view('thesis.edit', compact('thesis'));
    }

    public function show(Thesis $thesis)
    {
        $this->authorize($this->methodMappingTable['show'], $thesis);
        $thesis->corresponding_author = $thesis->corresponding_author == '0' ? '否' : '是';
        return view('thesis.show', compact('thesis'));
    }

    public function update(Request $request, Thesis $thesis)
    {
        $this->authorize($this->methodMappingTable['update'], $thesis);
        $data = $this->validation($request);
        $data = $this->removeAsciiControlCharacter($data);
        $data['username'] = Auth::user()->username;
        if (isset($data['identification'])) {
            $oldIdentification = $thesis->identification;
            Storage::delete('public/thesis/' . $oldIdentification . $this->fileExtension);
        }
        $thesis->update($data);
        return redirect()->route('thesis.index');
    }

    private function validation(Request $request)
    {
        $requestName = $request->route()->getName();
        $data = $request->validate([
            'publicationName' => ['required', 'string', 'max:255'],
            'publicationDate' => ['required', 'date_format:Y/m', 'after_or_equal:' . date("Y/m", strtotime("-5 years")), 'before_or_equal:' . date("Y/m", strtotime("now"))],
            'DOI' => ['required', 'string'],
            'authorNo' => ['required', 'integer', 'min:1'],
            'order' => ['required', 'integer', 'min:1'],
            'rank_factor' => ['required', 'string', 'regex:/\A\d+\/\d+\z/'],
            'corresponding_author' => ['required', 'in:0,1'],
            'thesisName' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:SCI,SCIE,SSCI,Other'],
            'identification' => [Rule::requiredIf($requestName == 'thesis.store'), 'file', 'mimes:pdf'],
        ]);

        if ($data['type'] == 'Other') $data['type'] = '其他';

        if (isset($data['identification'])) {
            $fileName = strtotime("now") . '.pdf';
            $request->file('identification')->storeAs('thesis', $fileName, 'public');
            $data['identification'] = $fileName;
        }

        return $data;
    }

    private function removeAsciiControlCharacter($data)
    {
        $stringColumns = ['publicationName', 'DOI', 'rank_factor', 'thesisName'];
        foreach ($stringColumns as $column) {
            preg_replace_array('/[\x00-\x1F\x7F]/', [''], $data[$column]);
        }
        return $data;
    }
}
