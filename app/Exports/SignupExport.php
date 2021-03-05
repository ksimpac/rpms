<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class SignupExport implements FromView
{

    private $users, $educations, $industry_experiences,
        $most_projects, $others, $tcases, $thesis_confs,
        $thesis;

    public function __construct(
        $users,
        $educations,
        $industry_experiences,
        $most_projects,
        $others,
        $tcases,
        $thesis_confs,
        $thesis
    ) {
        $this->users = $users;
        $this->educations = $educations;
        $this->industry_experiences = $industry_experiences;
        $this->most_projects = $most_projects;
        $this->others = $others;
        $this->tcases = $tcases;
        $this->thesis_confs = $thesis_confs;
        $this->thesis = $thesis;
    }

    public function view(): View
    {
        return view('excel_export', [
            'users' => $this->users->get(),
            'educations' => $this->educations,
            'industry_experiences' => $this->industry_experiences,
            'most_projects' => $this->most_projects,
            'others' => $this->others,
            'tcases' => $this->tcases,
            'thesis_confs' => $this->thesis_confs,
            'thesis' => $this->thesis,
        ]);
    }
}
