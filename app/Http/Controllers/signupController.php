<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class signupController extends Controller
{
    public function store()
    {

        DB::table('users')
            ->where('username', Auth::user()->username)
            ->update(['isSignup' => 1]);

        Alert::success('系統訊息', '已完成報名');
        return redirect()->back();
    }

    public function check()
    {
        $username = Auth::user()->username;
        $general_info = DB::table('general_info')
            ->where('username', $username)->count();
        $education = DB::table('education')
            ->select('degree')
            ->where('username', $username)->count();

        if (
            DB::table('thesis')
            ->where('username', $username)
            ->whereIn('type', ['SCI', 'SCIE', 'SSCI'])
            ->count() >= 2
        ) {
            $thesis = 1;
        } else {
            $thesis = 0;
        }

        if (
            DB::table('industry_experience')
            ->select(DB::raw("timestampdiff(YEAR,
            STR_TO_DATE(concat(startDate, '/01'), '%Y/%m/%d'),
            STR_TO_DATE(concat(endDate, '/01'), '%Y/%m/%d')) as yeardiff"))
            ->where('username', $username)->having('yeardiff', '>=', 1)->get()
            ->count() > 0
        ) {
            $industry_experience = 1;
        } else {
            $industry_experience = 0;
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
            $message .= "請填寫經歷或確認填寫的資料是否具備該項目的條件<br />";
        }

        if ($message != "") {
            Alert::html('錯誤', $message, 'error')->persistent(true, false);
            return redirect()->back();
        } else {
            return $this->store();
        }
    }
}
