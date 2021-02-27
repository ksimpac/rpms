<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\SignupExport;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
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
}
