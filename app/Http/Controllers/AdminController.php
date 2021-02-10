<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\SignupExport;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;


class AdminController extends Controller
{
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


        $users = User::where('isSignup', 1)->with(
            [
                'general_info',
                'educations',
                'industry_experiences',
                'most_projects',
                'others',
                'tcases',
                'thesis_confs',
                'thesis'
            ]
        )
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
