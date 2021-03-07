<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Classes\File;

class thesisController extends Controller
{
    public function index()
    {
        $collection = DB::table('thesis')
            ->where('username', Auth::user()->username)
            ->get();

        foreach ($collection as $item) {
            $item->corresponding_author == 0 ? $item->corresponding_author = '否' : $item->corresponding_author = '是';
        }
        return view('thesis.index', compact('collection'));
    }

    public function create()
    {
        return view('thesis.create');
    }

    public function store(Request $request)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        $data['created_at'] = $data['updated_at'] = now();
        DB::table('thesis')->insert([$data]);
        return redirect()->route('thesis.index');
    }

    public function destroy($id)
    {
        $queryBuilder = DB::table('thesis')->where('id', $id);
        $oldIdentification = $queryBuilder->first()->identification;
        File::delete(storage_path('app/public/thesis/'), $oldIdentification);
        $queryBuilder->delete();
        return redirect()->route('thesis.index');
    }

    public function edit($id)
    {
        $collection = DB::table('thesis')
            ->where('username', Auth::user()->username)
            ->where('id', $id)->first();

        return view('thesis.edit', compact('collection'));
    }

    public function show($id)
    {
        $collection = DB::table('thesis')
            ->where('username', Auth::user()->username)
            ->where('id', $id)->first();

        $collection->corresponding_author = $collection->corresponding_author == '0' ? '否' : '是';

        return view('thesis.show', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $data['updated_at'] = now();
        $table = DB::table('thesis');
        if (isset($data['identification'])) {
            $oldIdentification = $table->where('username', Auth::user()->username)
                ->where('id', $id)->first()->identification;
            File::delete(storage_path('app/public/thesis/'), $oldIdentification);
        }
        $table->update($data);
        return redirect()->route('thesis.index');
    }

    private function validation(Request $request)
    {
        $requestName = $request->route()->getName();
        $data = $request->validate([
            'publicationName' => ['required', 'string', 'max:255'],
            'publicationDate' => ['required', 'date_format:Y/m', 'after_or_equal:' . date("Y/m", strtotime("-5 years")), 'before_or_equal:' . date("Y/m", strtotime("now"))],
            'DOI' => ['required', 'string'],
            'authorNo' => ['required', 'integer', 'min:1'],
            'order' => ['required', 'integer', 'min:1'],
            'rank_factor' => ['required', 'string', 'regex:/\A\d+\/\d+\z/'],
            'corresponding_author' => ['required', 'in:0,1'],
            'thesisName' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:SCI,SCIE,SSCI,Other'],
            'identification' => [Rule::requiredIf($requestName == 'thesis.store'), 'file', 'mimes:pdf'],
        ]);

        if ($data['type'] == 'Other') $data['type'] = '其他';

        if (isset($data['identification'])) {
            $fileName = strtotime("now") . '.pdf';
            $request->file('identification')->storeAs('thesis', $fileName, 'public');
            $data['identification'] = $fileName;
        }

        return $data;
    }
}
