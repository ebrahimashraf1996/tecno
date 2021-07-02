<?php

namespace App\Http\Middleware;

use Closure;

class NoExMiddleware
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
        if(request()->getHttpHost()  === "server-test.techno1egypt.com"){
        return $next($request);
    }
        return response('404');
    }
}
