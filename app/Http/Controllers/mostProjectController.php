<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Classes\File;

class mostProjectController extends Controller
{
    public function index()
    {
        $collection = DB::table('most_project')
            ->where('username', Auth::user()->username)->get();
        return view('MOST_project.index', compact('collection'));
    }

    public function create()
    {
        return view('MOST_project.create');
    }

    public function store(Request $request)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('most_project')->insert([$data]);
        return redirect()->route('MOST_project.index');
    }

    public function destroy($id)
    {
        $queryBuilder = DB::table('most_project')->where('id', $id);
        $oldIdentification = $queryBuilder->first()->identification;
        File::delete(storage_path('app/public/MOST_project/'), $oldIdentification);
        $queryBuilder->delete();
        return redirect()->route('MOST_project.index');
    }

    public function edit($id)
    {
        $collection = DB::table('most_project')
            ->where('username', Auth::user()->username)
            ->where('id', $id)->first();

        $collection->startDate = str_replace('-', '/', $collection->startDate);
        $collection->endDate = str_replace('-', '/', $collection->endDate);
        return view('MOST_project.edit', compact('collection'));
    }

    public function show($id)
    {
        $collection = DB::table('most_project')
            ->where('username', Auth::user()->username)
            ->where('id', $id)->first();

        return view('MOST_project.show', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $data['updated_at'] = now();
        $table = DB::table('most_project');
        if (isset($data['identification'])) {
            $oldIdentification = $table->where('username', Auth::user()->username)
                ->where('id', $id)->first()->identification;
            File::delete(storage_path('app/public/MOST_project/'), $oldIdentification);
        }
        $table->update($data);
        return redirect()->route('MOST_project.index');
    }

    private function validation(Request $request)
    {
        $requestName = $request->route()->getName();
        $data = $request->validate([
            'projectName' => ['required', 'string', 'max:255'],
            'startDate' => ['required', 'date_format:Y/m/d', 'after_or_equal:' . date("Y/m/d", strtotime("-5 years"))],
            'endDate' => ['required', 'date_format:Y/m/d', 'after:startDate', 'before_or_equal:' . date("Y/m/d", strtotime("now"))],
            'jobkind' => ['required', 'in:0,1'],
            'plantotal_money' => ['required', 'integer', 'max:9999999999'],
            'identification' => [Rule::requiredIf($requestName == 'MOST_project.store'), 'file', 'mimes:pdf'],
        ]);

        $jobkind = array('0' => '主持人', '1' => '共同主持人');
        $data['jobkind'] = $jobkind[$data['jobkind']];

        if (isset($data['identification'])) {
            $fileName = strtotime("now") . '.pdf';
            $request->file('identification')->storeAs('MOST_project', $fileName, 'public');
            $data['identification'] = $fileName;
        }

        return $data;
    }
}
