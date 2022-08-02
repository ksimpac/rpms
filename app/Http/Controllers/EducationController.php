<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Education;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class EducationController extends Controller
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
        $this->authorize($this->methodMappingTable['index'], Education::class);
        $collection = Education::where('username', Auth::user()->username)->get();
        return view('education.index', compact('collection'));
    }

    public function create()
    {
        $this->authorize($this->methodMappingTable['create'], Education::class);

        if (Education::where('username', Auth::user()->username)->count() === 3) {
            Alert::error('錯誤', '學歷只能新增三筆資料');
            return redirect()->route('education.index');
        }

        return view('education.create');
    }

    public function store(Request $request)
    {
        $this->authorize($this->methodMappingTable['store'], Education::class);
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        Education::create($data);
        return redirect()->route('education.index');
    }

    public function destroy(Education $education)
    {
        $this->authorize($this->methodMappingTable['destroy'], $education);
        $oldCertificate = $education->certificate;
        $oldTranscript = $education->transcript;
        Storage::delete('public/education/transcript/' . $oldTranscript . $this->fileExtension);
        Storage::delete('public/education/certificate/' . $oldCertificate . $this->fileExtension);
        $education->delete();
        return redirect()->route('education.index');
    }

    public function edit(Education $education)
    {
        $this->authorize($this->methodMappingTable['edit'], $education);
        return view('education.edit', compact('education'));
    }

    public function show(Education $education)
    {
        $this->authorize($this->methodMappingTable['show'], $education);

        switch ($education->degree) {
            case 'Bachelor':
                $education->degree = '大學';
                break;
            case 'Master':
                $education->degree = '碩士';
                break;
            default:
                $education->degree = '博士';
        }

        return view('education.show', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $this->authorize($this->methodMappingTable['update'], $education);
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        $oldCertificate = $education->certificate;
        $oldTranscript = $education->transcript;

        if (isset($data['transcript'])) {
            Storage::delete('public/education/transcript/' . $oldTranscript . $this->fileExtension);
        }

        if (isset($data['certificate'])) {
            Storage::delete('public/education/certificate/' . $oldCertificate . $this->fileExtension);
        }

        $education->update($data);
        return redirect()->route('education.index');
    }

    private function validation(Request $request)
    {
        $requestName = $request->route()->getName();
        $degreeValidationNoUniqueRule = ['required', 'in:Bachelor,Master,PhD'];
        $degreeValidationHasUniqueRule = [
            'required', 'in:Bachelor,Master,PhD',
            Rule::unique('education', 'degree')->where(function ($query) {
                return $query->where('username', Auth::user()->username);
            })
        ];

        $data = $request->validate([
            'schoolName' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'startDate' => ['required', 'date_format:Y/m'],
            'endDate' => ['required', 'date_format:Y/m'],
            'status' => ['required', 'in:Graduation,Completion,Attendance'],
            'country' => ['required', 'string', 'max:255'],
            'degree' => $requestName == 'education.store' ? $degreeValidationHasUniqueRule : $degreeValidationNoUniqueRule,
            'thesis' => [
                'required_unless:degree,Bachelor', 'nullable', 'string', 'max:255'
            ],
            'advisor' => [
                'required_unless:degree,Bachelor', 'nullable', 'string', 'max:255'
            ],
            'certificate' => [Rule::requiredIf($requestName == 'education.store'), 'file', 'mimes:pdf'],
            'transcript' => [Rule::requiredIf($requestName == 'education.store'), 'file', 'mimes:pdf'],
        ]);

        $status = array('Graduation' => '畢業', 'Completion' => '結業', 'Attendance' => '肄業');
        $data['status'] = $status[$data['status']];

        $fileName = strtotime("now") . '.pdf';

        if (isset($data['transcript'])) {
            $request->file('transcript')->storeAs('education\transcript', $fileName, 'public');
            $data['transcript'] = $fileName;
        }

        if (isset($data['certificate'])) {
            $request->file('certificate')->storeAs('education\certificate', $fileName, 'public');
            $data['certificate'] = $fileName;
        }

        return $data;
    }
}
