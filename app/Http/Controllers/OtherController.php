<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Other;
use Illuminate\Support\Facades\Storage;

class OtherController extends Controller
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
        $this->authorize($this->methodMappingTable['index'], Other::class);
        $collection = Other::where('username', Auth::user()->username)->get();
        return view('other.index', compact('collection'));
    }

    public function create()
    {
        $this->authorize($this->methodMappingTable['create'], Other::class);
        return view('other.create');
    }

    public function store(Request $request)
    {
        $this->authorize($this->methodMappingTable['store'], Other::class);
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        Other::create($data);
        return redirect()->route('other.index');
    }

    public function destroy(Other $other)
    {
        $this->authorize($this->methodMappingTable['destroy'], $other);
        $oldIdentification = $other->identification;
        Storage::delete('public/other/' . $oldIdentification . $this->fileExtension);
        $other->delete();
        return redirect()->route('other.index');
    }

    public function edit(Other $other)
    {
        $this->authorize($this->methodMappingTable['edit'], $other);
        return view('other.edit', compact('other'));
    }

    public function update(Request $request, Other $other)
    {
        $this->authorize($this->methodMappingTable['update'], $other);
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        if (isset($data['identification'])) {
            $oldIdentification = $other->identification;
            Storage::delete('public/other/' . $oldIdentification . $this->fileExtension);
        }
        $other->update($data);
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
