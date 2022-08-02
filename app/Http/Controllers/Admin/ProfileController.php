<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    private $tables = [
        'general_info', 'educations', 'industry_experiences',
        'most_projects', 'others', 'tcases', 'thesis_confs', 'thesis'
    ];

    public function index()
    {
        Gate::authorize('profile', User::class);
        $collection = $this->getNameList();
        return view('admin.profile', compact('collection'));
    }

    public function show(Request $request)
    {
        Gate::authorize('profile', User::class);
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

        foreach ($user->educations as $education) {
            switch ($education->degree) {
                case 'Bachelor':
                    $education->degree = '大學';
                    break;
                case 'Master':
                    $education->degree = '碩士';
                    break;
                default:
                    $education->degree = '博士';
            }
        }

        return view('admin.profile', compact('collection', 'user'));
    }

    private function getNameList()
    {
        return User::where('isSignup', 1)->get();
    }
}
