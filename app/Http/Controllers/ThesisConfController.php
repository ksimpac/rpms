<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Thesis_conf;

class ThesisConfController extends Controller
{
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
        $this->authorize($this->methodMappingTable['index'], Thesis_conf::class);
        $collection = Thesis_conf::where('username', Auth::user()->username)->get();

        foreach ($collection as $item) {
            $item->corresponding_author == 0 ? $item->corresponding_author = '否' : $item->corresponding_author = '是';
        }

        return view('thesis_conf.index', compact('collection'));
    }

    public function create()
    {
        $this->authorize($this->methodMappingTable['create'], Thesis_conf::class);
        return view('thesis_conf.create');
    }

    public function store(Request $request)
    {
        $this->authorize($this->methodMappingTable['store'], Thesis_conf::class);
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        Thesis_conf::create($data);
        return redirect()->route('thesis_conf.index');
    }

    public function destroy(Thesis_conf $thesis_conf)
    {
        $this->authorize($this->methodMappingTable['destroy'], $thesis_conf);
        $thesis_conf->delete();
        return redirect()->route('thesis_conf.index');
    }

    public function edit(Thesis_conf $thesis_conf)
    {
        $this->authorize($this->methodMappingTable['edit'], $thesis_conf);
        return view('thesis_conf.edit', compact('thesis_conf'));
    }

    public function show(Thesis_conf $thesis_conf)
    {
        $this->authorize($this->methodMappingTable['show'], $thesis_conf);
        $thesis_conf->corresponding_author = $thesis_conf->corresponding_author == '0' ? '否' : '是';
        return view('thesis_conf.show', compact('thesis_conf'));
    }

    public function update(Request $request, Thesis_conf $thesis_conf)
    {
        $this->authorize($this->methodMappingTable['update'], $thesis_conf);
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        $thesis_conf->update($data);
        return redirect()->route('thesis_conf.index');
    }

    private function validation(Request $request)
    {
        $data = $request->validate([
            'conf_name' => ['required', 'string', 'max:255'],
            'thesisName' => ['required', 'string', 'max:255'],
            'years' => ['required', 'date_format:Y', 'after_or_equal:' . date("Y", strtotime("-5 years")), 'before_or_equal:' . date("Y", strtotime("now"))],
            'authorNo' => ['required', 'integer', 'min:1'],
            'corresponding_author' => ['required', 'in:0,1'],
            'country' => ['required', 'string', 'max:255'],
        ]);

        return $data;
    }
}
