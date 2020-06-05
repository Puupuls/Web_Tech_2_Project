<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UIData
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
        $trackers = [];
        if(!Auth::guest())
            $trackers = Auth::user()->trackers;
        View::share('trackers', $trackers);
        return $next($request);
    }
}
