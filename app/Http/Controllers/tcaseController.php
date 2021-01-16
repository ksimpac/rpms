<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class tcaseController extends Controller
{
    public function index()
    {
        $username = Auth::user()->username;
        $collection = DB::table('tcase')->where('username', $username)->get();
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
        DB::table('tcase')->where('id', $id)->delete();
        return redirect()->route('tcase.index');
    }

    public function edit($username, $id)
    {
        $collection = DB::table('tcase')
            ->where('username', $username)
            ->where('id', $id)->first();

        $collection->startDate = str_replace('-', '/', $collection->startDate);
        $collection->endDate = str_replace('-', '/', $collection->endDate);
        return view('tcase.edit', compact('collection'));
    }

    public function update(Request $request, $username, $id)
    {
        $data = $this->validation($request);
        $data['updated_at'] = now();
        DB::table('tcase')->where('username', $username)->where('id', $id)->update($data);
        return redirect()->route('tcase.index');
    }

    private function validation(Request $request)
    {
        $requestName = $request->route()->getName();
        $data = $request->validate([
            'projectName' => ['required', 'string', 'max:100'],
            'collaboration_name' => ['required', 'string', 'max:100'],
            'startDate' => ['required', 'date_format:Y/m/d'],
            'endDate' => ['required', 'date_format:Y/m/d'],
            'jobkind' => ['required', Rule::in(['主持人', '共同主持人'])],
            'plantotal_money' => ['required', 'integer', 'max:9999999999'],
            'identification' => [Rule::requiredIf($requestName == 'other.store'), 'file', 'mimes:pdf'],
        ]);

        if (isset($data['identification'])) {
            $fileName = strtotime("now") . '.pdf';
            $request->file('identification')->storeAs('tcase', $fileName, 'public');
            $data['identification'] = $fileName;
        }

        return $data;
    }
}
