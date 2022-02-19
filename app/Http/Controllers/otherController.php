<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Classes\File;

class otherController extends Controller
{
    public function index()
    {
        $collection = DB::table('other')
            ->where('username', Auth::user()->username)->get();
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
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('other')->insert([$data]);
        return redirect()->route('other.index');
    }

    public function destroy($id)
    {
        $queryBuilder = DB::table('other')->where('id', $id);
        $oldIdentification = $queryBuilder->first()->identification;
        File::delete(storage_path('app/public/other/'), $oldIdentification);
        $queryBuilder->delete();
        return redirect()->route('other.index');
    }

    public function edit($id)
    {
        $collection = DB::table('other')
            ->where('username', Auth::user()->username)
            ->where('id', $id)->first();

        return view('other.edit', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $data['updated_at'] = now();
        $row = DB::table('other')->where('username', Auth::user()->username)
            ->where('id', $id);
        if (isset($data['identification'])) {
            $oldIdentification = $row->identification;
            File::delete(storage_path('app/public/other/'), $oldIdentification);
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
