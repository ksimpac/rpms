<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Thesis;
use Illuminate\Support\Facades\Storage;

class thesisController extends Controller
{

    private $fileExtension = '.pdf';

    public function index()
    {
        $collection = Thesis::where('username', Auth::user()->username)->get();

        foreach ($collection as $item) {
            $item->corresponding_author == 0 ? $item->corresponding_author = '否' : $item->corresponding_author = '是';
        }

        return view('thesis.index', compact('collection'));
    }

    public function create()
    {
        return view('thesis.create');
    }

    public function store(Request $request)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        Thesis::create($data);
        return redirect()->route('thesis.index');
    }

    public function destroy($id)
    {
        $row = Thesis::where('id', $id)->firstOrFail();
        $oldIdentification = $row->identification;
        Storage::delete('public/thesis/' . $oldIdentification . $this->fileExtension);
        $row->delete();
        return redirect()->route('thesis.index');
    }

    public function edit($id)
    {
        $collection = Thesis::where('id', $id)->firstOrFail();
        return view('thesis.edit', compact('collection'));
    }

    public function show($id)
    {
        $collection = Thesis::where('id', $id)->firstOrFail();
        $collection->corresponding_author = $collection->corresponding_author == '0' ? '否' : '是';
        return view('thesis.show', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        $row = Thesis::where('id', $id)->firstOrFail();
        if (isset($data['identification'])) {
            $oldIdentification = $row->identification;
            Storage::delete('public/thesis/' . $oldIdentification . $this->fileExtension);
        }
        $row->update($data);
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
}
