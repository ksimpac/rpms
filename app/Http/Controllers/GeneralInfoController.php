<?php

namespace App\Http\Controllers;

use App\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\General_info;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class GeneralInfoController extends Controller
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
        $this->authorize($this->methodMappingTable['index'], General_info::class);
        $collection = General_info::where('username', Auth::user()->username)->get();
        return view('general_info.index', compact('collection'));
    }

    public function create()
    {
        $this->authorize($this->methodMappingTable['create'], General_info::class);

        if (General_info::where('username', Auth::user()->username)->count() > 0) {
            Alert::error('錯誤', '基本資料只能新增一筆');
            return redirect()->route('general_info.index');
        }

        return view('general_info.create');
    }

    public function store(Request $request)
    {
        $this->authorize($this->methodMappingTable['store'], General_info::class);
        $data = $this->validation($request);
        $data = $this->removeAsciiControlCharacter($data);
        $data['username'] = Auth::user()->username;
        General_info::create($data);
        return redirect()->route('general_info.index');
    }

    public function destroy(General_info $general_info)
    {
        $this->authorize($this->methodMappingTable['destroy'], $general_info);
        $oldTeacherCertificateFiles = $general_info->teacherCertificateFiles;
        if (isset($oldTeacherCertificateFiles)) {
            Storage::delete('public/general_info/' . $oldTeacherCertificateFiles . $this->fileExtension);
        }
        $general_info->delete();
        return redirect()->route('general_info.index');
    }

    public function edit(General_info $general_info)
    {
        $this->authorize($this->methodMappingTable['edit'], $general_info);
        $general_info->birthday = str_replace('-', '/', $general_info->birthday);
        return view('general_info.edit', compact('general_info'));
    }

    public function update(Request $request, General_info $general_info)
    {
        $this->authorize($this->methodMappingTable['update'], $general_info);
        $data = $this->validation($request);
        $data = $this->removeAsciiControlCharacter($data);
        $data['username'] = Auth::user()->username;
        if (isset($data['teacherCertificateFiles'])) {
            $oldTeacherCertificateFiles = $general_info->teacherCertificateFiles;
            Storage::delete('public/general_info/' . $oldTeacherCertificateFiles . $this->fileExtension);
        }
        $general_info->update($data);
        return redirect()->route('general_info.index');
    }

    public function show(General_info $general_info)
    {
        $this->authorize($this->methodMappingTable['show'], $general_info);
        $general_info->sex == 0 ? $general_info->gender = '女' : $general_info->gender = '男';
        return view('general_info.show', compact('general_info'));
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
            'teacherCertificateType' => [
                'required',
                'in:Professor,Associate Professor,Assistant Professor,Lecturer,None'
            ],
            'teacherCertificateFiles' => [Rule::requiredIf(function () use ($request, $requestName) {
                return $requestName == 'general_info.store' && $request->input('teacherCertificateType') != 'None';
            }), 'file', 'mimes:pdf'],
            'working_units' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'startDate' => ['required', 'date_format:Y/m'],
            'specialization' => ['required', 'in:0,1,2,3'],
            'course' => ['required', 'string'],
        ]);

        $teacherCertificateType = array(
            'Professor' => '教授',
            'Associate Professor' => '副教授',
            'Assistant Professor' => '助理教授',
            'Lecturer' => '講師',
            'None' => '無'
        );

        $specialization = array(
            '0' => '智慧流通',
            '1' => '物流運輸',
            '2' => '新零售',
            '3' => '其他',
        );

        $data['teacherCertificateType'] = $teacherCertificateType[$data['teacherCertificateType']];
        $data['specialization'] = $specialization[$data['specialization']];

        if (isset($data['teacherCertificateFiles'])) {
            $fileName = strtotime("now") . '.pdf';
            $request->file('teacherCertificateFiles')->storeAs('general_info', $fileName, 'public');
            $data['teacherCertificateFiles'] = $fileName;
        }

        return $data;
    }

    private function removeAsciiControlCharacter($data)
    {
        $stringColumns = [
            'englishLastName', 'englishFirstName', 'telephone', 'Permanent_Address',
            'Residential_Address', 'working_units', 'position', 'course'
        ];
        foreach ($stringColumns as $column) {
            preg_replace_array('/[\x00-\x1F\x7F]/', [''], $data[$column]);
        }
        return $data;
    }
}
