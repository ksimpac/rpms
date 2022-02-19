<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Classes\File;

class tcaseController extends Controller
{
    public function index()
    {
        $collection = DB::table('tcase')
            ->where('username', Auth::user()->username)->get();
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
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('tcase')->insert([$data]);
        return redirect()->route('tcase.index');
    }

    public function destroy($id)
    {
        $queryBuilder = DB::table('tcase')->where('id', $id);
        $oldIdentification = $queryBuilder->first()->identification;
        File::delete(storage_path('app/public/tcase/'), $oldIdentification);
        $queryBuilder->delete();
        return redirect()->route('tcase.index');
    }

    public function edit($id)
    {
        $collection = DB::table('tcase')
            ->where('username', Auth::user()->username)
            ->where('id', $id)->first();

        $collection->startDate = str_replace('-', '/', $collection->startDate);
        $collection->endDate = str_replace('-', '/', $collection->endDate);
        return view('tcase.edit', compact('collection'));
    }

    public function show($id)
    {
        $collection = DB::table('tcase')
            ->where('username', Auth::user()->username)
            ->where('id', $id)->first();

        return view('tcase.show', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $data['updated_at'] = now();
        $row = DB::table('tcase')->where('username', Auth::user()->username)
            ->where('id', $id);
        if (isset($data['identification'])) {
            $oldIdentification = $row->identification;
            File::delete(storage_path('app/public/tcase/'), $oldIdentification);
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
