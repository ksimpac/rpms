<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\SignupExport;
use App\User;
use App\Deadline;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    private $tables = [
        'general_info', 'educations', 'industry_experiences',
        'most_projects', 'others', 'tcases', 'thesis_confs', 'thesis'
    ];

    public function export(Request $request)
    {
        $users = User::where('isSignup', 1)->with($this->tables)
            ->where('updated_at', '<=', Deadline::find(1)->time)
            ->withCount([
                'educations',
                'industry_experiences',
                'most_projects',
                'others',
                'tcases',
                'thesis_confs',
                'thesis'
            ]);

        $educations = User::where('isSignup', 1)->with($this->tables)
            ->where('updated_at', '<=', Deadline::find(1)->time)
            ->withCount([
                'educations',
            ])->orderBy('educations_count', 'DESC')->first();

        $industry_experiences = User::where('isSignup', 1)->with($this->tables)
            ->where('updated_at', '<=', Deadline::find(1)->time)
            ->withCount([
                'industry_experiences',
            ])->orderBy('industry_experiences_count', 'DESC')->first();

        $most_projects = User::where('isSignup', 1)->with($this->tables)
            ->where('updated_at', '<=', Deadline::find(1)->time)
            ->withCount([
                'most_projects',
            ])->orderBy('most_projects_count', 'DESC')->first();

        $others = User::where('isSignup', 1)->with($this->tables)
            ->where('updated_at', '<=', Deadline::find(1)->time)
            ->withCount([
                'others',
            ])->orderBy('others_count', 'DESC')->first();

        $tcases = User::where('isSignup', 1)->with($this->tables)
            ->where('updated_at', '<=', Deadline::find(1)->time)
            ->withCount([
                'tcases',
            ])->orderBy('tcases_count', 'DESC')->first();

        $thesis_confs = User::where('isSignup', 1)->with($this->tables)
            ->where('updated_at', '<=', Deadline::find(1)->time)
            ->withCount([
                'thesis_confs',
            ])->orderBy('thesis_confs_count', 'DESC')->first();

        $thesis = User::where('isSignup', 1)->with($this->tables)
            ->where('updated_at', '<=', Deadline::find(1)->time)
            ->withCount([
                'thesis',
            ])->orderBy('thesis_count', 'DESC')->first();


        if ($users->get()->isEmpty()) {
            Alert::info('系統訊息', '目前尚未有人報名');
            return redirect()->back();
        }

        return Excel::download(new SignupExport(
            $users,
            $educations,
            $industry_experiences,
            $most_projects,
            $others,
            $tcases,
            $thesis_confs,
            $thesis
        ), '報名資訊.xlsx');
    }
}
