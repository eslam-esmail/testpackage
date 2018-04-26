<?php

namespace OlaHub\Middlewares;

use Closure;

class RequestTypeMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request 
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (strtoupper($request->method()) == 'OPTIONS') {
            return $next($request);
        } else {
            if ($request->header('x-requested-with')) {
                return $next($request);
            }
            abort(404);
        }
    }

}
