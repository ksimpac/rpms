<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class user
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
        $url_id = $request->route()->parameter('id');

        if (!isset($url_id)) {
            return $next($request);
        }

        $uri = explode('/', $request->route()->uri());
        $tableName = $uri[1];
        $username = Auth::user()->username; //real username

        $data = DB::table($tableName)->where('id', $url_id)->first();

        if (isset($data->username) && $data->username !== $username) {
            abort(404);
        } else {
            return $next($request);
        }
    }
}
