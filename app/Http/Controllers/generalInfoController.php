<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class generalInfoController extends Controller
{
    public function index()
    {
        $collection = DB::table('general_info')
            ->where('username', Auth::user()->username)->get();
        return view('general_info.index', compact('collection'));
    }

    public function create()
    {
        return view('general_info.create');
    }

    public function store(Request $request)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('general_info')->insert([$data]);
        return redirect()->route('general_info.index');
    }

    public function destroy($id)
    {
        DB::table('general_info')->where('id', $id)->delete();
        return redirect()->route('general_info.index');
    }

    public function edit($id)
    {
        $collection = DB::table('general_info')
            ->where('username', Auth::user()->username)
            ->where('id', $id)->first();

        $collection->birthday = str_replace('-', '/', $collection->birthday);
        return view('general_info.edit', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $data['updated_at'] = now();
        DB::table('general_info')
            ->where('username', Auth::user()->username)
            ->where('id', $id)->update($data);
        return redirect()->route('general_info.index');
    }

    public function show($id)
    {
        $collection = DB::table('general_info')
            ->where('username', Auth::user()->username)
            ->where('id', $id)->first();

        $collection->sex == 0 ? $collection->gender = '女' : $collection->gender = '男';
        return view('general_info.show', compact('collection'));
    }

    private function validation(Request $request)
    {
        $requestName = $request->route()->getName();
        $data = $request->validate([
            'englishLastName' => ['required', 'string', 'max:255'],
            'englishFirstName' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date_format:Y/m/d'],
            'sex' => ['required', 'in:0,1'],
            'telephone' => ['required', 'string', 'min:10', 'max:10'],
            'Permanent_Address' => ['required', 'string', 'max:255'],
            'Residential_Address' => ['required', 'string', 'max:255'],
            'teacherCertificateType' => ['required', 'in:教授,副教授,助理教授,講師,無'],
            'teacherCertificateFiles' => [Rule::requiredIf(function () use ($request, $requestName) {
                return $requestName == 'general_info.store' && $request->input('teacherCertificateType') != '無';
            }), 'file', 'mimes:pdf'],
            'working_units' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'startDate' => ['required', 'date_format:Y/m'],
            'specialization' => ['required', Rule::in(['智慧流通', '物流運輸', '新零售', '其他'])],
            'course' => ['required', 'string'],
        ]);

        if (isset($data['teacherCertificateFiles'])) {
            $fileName = strtotime("now") . '.pdf';
            $request->file('teacherCertificateFiles')->storeAs('general_info', $fileName, 'public');
            $data['teacherCertificateFiles'] = $fileName;
        }

        return $data;
    }
}
