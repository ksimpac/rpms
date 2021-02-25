<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\SignupExport;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;


class AdminController extends Controller
{

    private $tables = [
        'general_info', 'educations', 'industry_experiences',
        'most_projects', 'others', 'tcases', 'thesis_confs', 'thesis'
    ];

    public function index()
    {
        return view('admin.export');
    }

    public function export(Request $request)
    {
        $data = $request->validate([
            'startDate' => ['required', 'date_format:Y-m-d H:i'],
            'endDate' => ['required', 'date_format:Y-m-d H:i', 'after:startDate']
        ]);


        $users = User::where('isSignup', 1)->with($this->tables)
            ->whereBetween('updated_at', [$data['startDate'], $data['endDate']])
            ->withCount([
                'educations',
                'industry_experiences',
                'most_projects',
                'others',
                'tcases',
                'thesis_confs',
                'thesis'
            ]);

        if ($users->get()->isEmpty()) {
            Alert::info('系統訊息', '目前尚未有人報名');
            return redirect()->back();
        }


        return Excel::download(new SignupExport($users), '報名資訊.xlsx');
    }

    public function profile()
    {
        $collection = $this->getNameList();
        return view('admin.profile', compact('collection'));
    }

    public function review(Request $request)
    {
        $collection = $this->getNameList();
        $data = $request->validate(
            [
                'nameList' => ['required', 'string', 'exists:users,id']
            ]
        );

        $user = User::where('id', $data['nameList'])->with($this->tables)->withCount([
            'thesis as SCI_count' => function ($query) {
                $query->where('type', 'SCI');
            },
            'thesis as SCIE_count' => function ($query) {
                $query->where('type', 'SCIE');
            },
            'thesis as SSCI_count' => function ($query) {
                $query->where('type', 'SSCI');
            },
            'thesis as others_count' => function ($query) {
                $query->where('type', '其他');
            },
            'thesis_confs'
        ])->first();

        $degree_order = ['博士', '碩士', '大學'];
        $user->educations = $user->educations->sortBy(function ($data) use ($degree_order) {
            return array_search($data->degree, $degree_order);
        });

        return view('admin.profile', compact('collection', 'user'));
    }

    public function getNameList()
    {
        $collection = User::where('isSignup', 1)->get();
        return $collection;
    }
}
