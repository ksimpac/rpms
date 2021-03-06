<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Classes\File;

class educationController extends Controller
{
    public function index()
    {
        $collection = DB::table('education')
            ->where('username', Auth::user()->username)->get();
        return view('education.index', compact('collection'));
    }

    public function create()
    {
        return view('education.create');
    }

    public function store(Request $request)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('education')->insert($data);
        return redirect()->route('education.index');
    }

    public function destroy($id)
    {
        $queryBuilder = DB::table('education')->where('id', $id);
        $row = $queryBuilder->first();
        $oldCertificate = $row->certificate;
        $oldTranscript = $row->transcript;
        File::delete(storage_path('app/public/education/transcript/'), $oldTranscript);
        File::delete(storage_path('app/public/education/certificate/'), $oldCertificate);
        $queryBuilder->delete();
        return redirect()->route('education.index');
    }

    public function edit($id)
    {
        $collection = DB::table('education')
            ->where('username', Auth::user()->username)
            ->where('id', $id)->first();

        return view('education.edit', compact('collection'));
    }

    public function show($id)
    {
        $collection = DB::table('education')
            ->where('username', Auth::user()->username)
            ->where('id', $id)->first();

        switch ($collection->degree) {
            case 'Bachelor':
                $collection->degree = '大學';
                break;
            case 'Master':
                $collection->degree = '碩士';
                break;
            default:
                $collection->degree = '博士';
        }

        return view('education.show', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $data['updated_at'] = now();
        $table = DB::table('education');
        $row = $table->where('username', Auth::user()->username)
            ->where('id', $id)->first();
        $oldCertificate = $row->certificate;
        $oldTranscript = $row->transcript;

        if (isset($data['transcript'])) {
            File::delete(storage_path('app/public/education/transcript/'), $oldTranscript);
        }

        if (isset($data['certificate'])) {
            File::delete(storage_path('app/public/education/certificate/'), $oldCertificate);
        }

        $table->update($data);
        return redirect()->route('education.index');
    }

    private function validation(Request $request)
    {
        $requestName = $request->route()->getName();
        $degreeValidationNoUniqueRule = ['required', 'in:Bachelor,Master,PhD'];
        $degreeValidationHasUniqueRule = array([
            'required', 'in:Bachelor,Master,PhD',
            Rule::unique('education', 'degree')->where(function ($query) {
                return $query->where('username', Auth::user()->username);
            })
        ]);

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
