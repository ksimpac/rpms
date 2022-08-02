<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RemoveUsersController extends Controller
{
    public function index()
    {
        Gate::authorize('removeUsers', User::class);
        $users = User::where('is_admin', 0)->paginate(7);
        return view('admin.removeUsers', compact('users'));
    }

    public function delete()
    {
        Gate::authorize('removeUsers', User::class);
        $directories = Storage::allDirectories('public');

        foreach ($directories as $directory) {
            Storage::deleteDirectory($directory);
        }

        User::where('is_admin', 0)->forceDelete();
        Alert::success('系統訊息', '已刪除管理員以外的使用者');
        return redirect()->back();
    }

    public function removeSelectedUsers(Request $request)
    {
        Gate::authorize('removeUsers', User::class);

        foreach ($request['user'] as $key => $value) {
            $username = User::where('id', $key)->value('username');
            $this->deleteUserFiles($username);
            User::where('id', $key)->forceDelete();
        }

        Alert::success('系統訊息', '已刪除選取的使用者');
        return redirect()->back();
    }

    private function deleteUserFiles($username)
    {
        $fileExtension = '.pdf';
        Storage::delete('public/general_info/' . \App\General_info::where('username', $username)->value('teacherCertificateFiles') . $fileExtension);

        foreach (\App\Education::where('username', $username)->pluck('certificate') as $value) {
            Storage::delete('public/education/certificate/' . $value . $fileExtension);
        }

        foreach (\App\Education::where('username', $username)->pluck('transcript') as $value) {
            Storage::delete('public/education/transcript' . $value . $fileExtension);
        }

        foreach (\App\Thesis::where('username', $username)->pluck('identification') as $value) {
            Storage::delete('public/thesis/' . $value . $fileExtension);
        }

        foreach (\App\Industry_experience::where('username', $username)->pluck('identification') as $value) {
            Storage::delete('public/industry_experience/' . $value . $fileExtension);
        }

        foreach (\App\Tcase::where('username', $username)->pluck('identification') as $value) {
            Storage::delete('public/tcase/' . $value . $fileExtension);
        }

        foreach (\App\Most_project::where('username', $username)->pluck('identification') as $value) {
            Storage::delete('public/most_project/' . $value . $fileExtension);
        }

        foreach (\App\Other::where('username', $username)->pluck('identification') as $value) {
            Storage::delete('public/other/' . $value . $fileExtension);
        }
    }
}
