<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Deadline;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;


class ResetsignupController extends Controller
{
    public function index()
    {
        return view('admin.resetSignup');
    }

    public function update()
    {
        $deadline = new Carbon(Deadline::find(1)->time);
        $now = Carbon::now();

        if ($deadline < $now) {
            Alert::error('錯誤', '請先將截止日期延後');
            return redirect()->back();
        }

        User::where('is_admin', 0)->update(['isSignup' => '0']);
        Alert::success('系統訊息', '已完成設定');
        return redirect()->back();
    }
}
