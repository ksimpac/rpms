<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\Debugbar\Facade as Debugbar;


class AdminController extends Controller
{
    public function index()
    {
        return view('admin.export');
    }

    public function export(Request $request)
    {
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
        )->withCount([
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

        return view('excel_export', [
            'users' => $users->get(),
            'educations' => $users->orderBy('educations_count', 'DESC')->first(),
            'industry_experiences' => $users->orderBy('industry_experiences_count', 'DESC')->first(),
            'most_projects' => $users->orderBy('most_projects_count', 'DESC')->first(),
            'others' => $users->orderBy('others_count', 'DESC')->first(),
            'tcases' => $users->orderBy('tcases_count', 'DESC')->first(),
            'thesis_confs' => $users->orderBy('thesis_confs_count', 'DESC')->first(),
            'thesis' => $users->orderBy('thesis_count', 'DESC')->first(),
        ]);
    }
}
