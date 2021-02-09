<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;


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
        );

        if ($users->get()->isEmpty()) {
            Alert::info('系統訊息', '目前尚未有人報名');
            return redirect()->back();
        }

        $educations = $users->withCount('educations')->orderBy('educations_count', 'DESC')->first();
        $industry_experiences = $users->withCount('industry_experiences')->orderBy('industry_experiences_count', 'DESC')->first();
        $most_projects = $users->withCount('most_projects')->orderBy('most_projects_count', 'DESC')->first();
        $others = $users->withCount('others')->orderBy('others_count', 'DESC')->first();
        $tcases = $users->withCount('tcases')->orderBy('tcases_count', 'DESC')->first();
        $thesis_confs = $users->withCount('thesis_confs')->orderBy('thesis_confs_count', 'DESC')->first();
        $thesis = $users->withCount('thesis')->orderBy('thesis_count', 'DESC')->first();

        $users = $users->get();

        return view('excel_export', compact(
            'users',
            'educations',
            'industry_experiences',
            'most_projects',
            'others',
            'tcases',
            'thesis_confs',
            'thesis'
        ));
    }
}
