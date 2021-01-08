<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
        $method = $request->route()->methods[0]; //get form method
        $url_username = $request->route()->parameter('username'); //username in url
        $username = Auth::user()->username; //real username

        if ($method == 'GET' || $url_username == null) return $next($request);

        if ($url_username != $username) {
            return abort(403);
        } else {
            return $next($request);
        }
    }
}
