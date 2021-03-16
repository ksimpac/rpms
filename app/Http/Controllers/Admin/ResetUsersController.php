<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class ResetUsersController extends Controller
{
    public function index()
    {
        return view('admin.resetUsers');
    }

    public function update()
    {
        $directories = Storage::allDirectories('public');

        foreach ($directories as $directory) {
            Storage::deleteDirectory($directory);
        }

        User::where('is_admin', 0)->forceDelete();
        Alert::success('系統訊息', '已刪除管理員以外的使用者');
        return redirect()->back();
    }
}
