<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Other;
use Illuminate\Support\Facades\Storage;

class otherController extends Controller
{

    private $fileExtension = '.pdf';

    public function index()
    {
        $collection = Other::where('username', Auth::user()->username)->get();
        return view('other.index', compact('collection'));
    }

    public function create()
    {
        return view('other.create');
    }

    public function store(Request $request)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        Other::create($data);
        return redirect()->route('other.index');
    }

    public function destroy($id)
    {
        $row = Other::where('id', $id)->firstOrFail();
        $oldIdentification = $row->identification;
        Storage::delete('public/other/' . $oldIdentification . $this->fileExtension);
        $row->delete();
        return redirect()->route('other.index');
    }

    public function edit($id)
    {
        $collection = Other::where('id', $id)->firstOrFail();
        return view('other.edit', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        $row = Other::where('id', $id)->firstOrFail();
        if (isset($data['identification'])) {
            $oldIdentification = $row->identification;
            Storage::delete('public/other/' . $oldIdentification . $this->fileExtension);
        }
        $row->update($data);
        return redirect()->route('other.index');
    }

    private function validation(Request $request)
    {
        $requestName = $request->route()->getName();
        $data = $request->validate([
            'identification' => [Rule::requiredIf($requestName == 'other.store'), 'file', 'mimes:pdf'],
        ]);

        if (isset($data['identification'])) {
            $fileName = strtotime("now") . '.pdf';
            $request->file('identification')->storeAs('other', $fileName, 'public');
            $data['identification'] = $fileName;
        }

        return $data;
    }
}
