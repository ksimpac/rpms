<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use App\General_info;
use App\Education;
use App\Thesis;
use App\Industry_experience;
use App\Most_project;
use App\Thesis_conf;

class SignupController extends Controller
{
    public function store()
    {
        User::where('username', Auth::user()->username)->update([
            'isSignup' => 1,
            'updated_at' => now()
        ]);

        Alert::success('系統訊息', '已完成報名');
        return redirect()->back();
    }

    public function check()
    {
        $username = Auth::user()->username;
        $general_info = General_info::where('username', $username)->count();
        $education = Education::select('degree')->where('username', $username)->count();

        if (
            Thesis::where('username', $username)
            ->whereIn('type', ['SCI', 'SCIE', 'SSCI'])
            ->count() >= 2 &&
            Thesis::select(DB::raw("timestampdiff(YEAR,
            STR_TO_DATE(concat(publicationDate, '/01'), '%Y/%m/%d'),
            NOW()) as yeardiff"))->where('username', $username)
            ->having('yeardiff', '>', 5)->get()->count() == 0
        ) {
            $thesis = 1;
        } else {
            $thesis = 0;
        }

        if (
            Industry_experience::select(DB::raw("timestampdiff(YEAR,
            STR_TO_DATE(concat(startDate, '/01'), '%Y/%m/%d'),
            STR_TO_DATE(concat(endDate, '/01'), '%Y/%m/%d')) as yeardiff"))
            ->where('username', $username)->having('yeardiff', '>=', 1)->get()
            ->count() > 0
        ) {
            $industry_experience = 1;
        } else {
            $industry_experience = 0;
        }

        if (
            Most_project::select(DB::raw("timestampdiff(YEAR, startDate,
            NOW()) as yeardiff"))->where('username', $username)
            ->having('yeardiff', '>', 5)->get()->count() > 0
        ) {
            $most_project = 0;
        } else {
            $most_project = 1;
        }

        if (
            Thesis_conf::select(DB::raw("timestampdiff(YEAR,
            DATE(concat(years, '-01-01')), NOW()) as yeardiff"))
            ->where('username', $username)->having('yeardiff', '>', 5)
            ->get()->count() > 0
        ) {
            $thesis_conf = 0;
        } else {
            $thesis_conf = 1;
        }


        $message = "";

        if ($general_info < 1) {
            $message .= "請填寫基本資料<br />";
        }

        if ($education < 3) {
            $message .= "請確認學歷填寫的資料是否具備該項目的條件<br />";
        }

        if ($thesis < 1) {
            $message .= "請確認期刊論文填寫的資料是否具備該項目的條件<br />";
        }

        if ($industry_experience < 1) {
            $message .= "請確認經歷填寫的資料是否具備該項目的條件<br />";
        }

        if ($most_project < 1) {
            $message .= "科技部專題研究計畫不允許超過5年的資料<br />";
        }

        if ($thesis_conf < 1) {
            $message .= "研討會論文不允許超過5年的資料<br />";
        }

        if ($message != "") {
            Alert::html('錯誤', $message, 'error')->persistent(true, false);
            return redirect()->back();
        } else {
            return $this->store();
        }
    }
}
