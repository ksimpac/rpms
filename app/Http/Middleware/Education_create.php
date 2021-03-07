<?php

namespace App\Http\Middleware;

use Closure;
use App\Education;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class Education_create
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
        $result = Education::where('username', Auth::user()->username)->count();

        if ($result < 3) {
            return $next($request);
        } else {
            Alert::error('錯誤', '學歷只能新增三筆資料');
            return redirect()->route('education.index');
        }
    }
}
