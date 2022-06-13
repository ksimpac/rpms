<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Thesis_conf;

class thesisConfController extends Controller
{
    public function index()
    {
        $collection = Thesis_conf::where('username', Auth::user()->username)->get();

        foreach ($collection as $item) {
            $item->corresponding_author == 0 ? $item->corresponding_author = '否' : $item->corresponding_author = '是';
        }

        return view('thesis_conf.index', compact('collection'));
    }

    public function create()
    {
        return view('thesis_conf.create');
    }

    public function store(Request $request)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        Thesis_conf::create($data);
        return redirect()->route('thesis_conf.index');
    }

    public function destroy($id)
    {
        Thesis_conf::where('id', $id)->delete();
        return redirect()->route('thesis_conf.index');
    }

    public function edit($id)
    {
        $collection = Thesis_conf::where('id', $id)->firstOrFail();
        return view('thesis_conf.edit', compact('collection'));
    }

    public function show($id)
    {
        $collection = Thesis_conf::where('id', $id)->firstOrFail();
        $collection->corresponding_author = $collection->corresponding_author == '0' ? '否' : '是';
        return view('thesis_conf.show', compact('collection'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validation($request);
        $data['username'] = Auth::user()->username;
        Thesis_conf::where('id', $id)->firstOrFail()->update($data);
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
