<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Deadline;
use RealRashid\SweetAlert\Facades\Alert;


class DeadlineController extends Controller
{
    public function index()
    {
        return view('admin.deadline');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'deadline' => ['required', 'date_format:Y-m-d H:i']
        ]);

        $weekday = ['日', '一', '二', '三', '四', '五', '六'];
        $timestamp = strtotime($data['deadline']);
        $deadline = date('Y', $timestamp) - 1911 . '年' .
            date('m', $timestamp) . '月' .
            date('d', $timestamp) . '日' .
            '(' . $weekday[date('w', $timestamp)] . ')'
            . ' ' . date('H:i', $timestamp);

        Deadline::updateOrCreate(
            [
                'id' => 1,
                'roc_format' => $deadline,
                'time' => $data['deadline']
            ]
        );

        Alert::info('系統訊息', '設定成功');
        return redirect()->back();
    }
}
