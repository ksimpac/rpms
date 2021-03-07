<?php

namespace App\Http\Middleware;

use Closure;
use App\General_info;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class General_info_create
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $result = General_info::where('username', Auth::user()->username)->count();

        if ($result == 0) {
            return $next($request);
        } else {
            Alert::error('錯誤', '基本資料只能新增一筆');
            return redirect()->route('general_info.index');
        }
    }
}
