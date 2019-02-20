<?php

namespace App\Http\Middleware;

use App\Helpers\Constant;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role !== Constant::ADMIN) {
            abort(404);
        }

        return $next($request);
    }
}
