<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use App\Deadline;
use RealRashid\SweetAlert\Facades\Alert;

class isDeadline
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
        $now = Carbon::now();
        $deadline = Carbon::createFromFormat('Y-m-d H:i:s', Deadline::first()->time);

        if ($now >= $deadline) {
            Alert::error('錯誤', '報名時間已截止');
            return redirect()->back();
        }

        return $next($request);
    }
}
