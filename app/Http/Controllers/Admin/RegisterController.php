<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class RegisterController extends Controller
{
    public function index()
    {
        Gate::authorize('register', User::class);
        return view('admin.register');
    }

    public function store(Request $request)
    {
        Gate::authorize('register', User::class);
        $data = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'max:255', 'confirmed'],
            'chineseName' => ['required', 'string', 'max:255']
        ]);

        User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'chineseName' => $data['chineseName'],
            'is_admin' => 1,
        ]);

        return redirect()->back()->with('success', '帳號建立成功!');
    }
}
