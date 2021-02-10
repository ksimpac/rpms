<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class SignupExport implements FromView
{

    private $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function view(): View
    {
        return view('excel_export', [
            'users' => $this->users->get(),
            'educations' => $this->users->orderBy('educations_count', 'DESC')->first(),
            'industry_experiences' => $this->users->orderBy('industry_experiences_count', 'DESC')->first(),
            'most_projects' => $this->users->orderBy('most_projects_count', 'DESC')->first(),
            'others' => $this->users->orderBy('others_count', 'DESC')->first(),
            'tcases' => $this->users->orderBy('tcases_count', 'DESC')->first(),
            'thesis_confs' => $this->users->orderBy('thesis_confs_count', 'DESC')->first(),
            'thesis' => $this->users->orderBy('thesis_count', 'DESC')->first(),
        ]);
    }
}
