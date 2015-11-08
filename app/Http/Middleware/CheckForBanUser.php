<?php

namespace App\Http\Middleware;

use Closure;

class CheckForBanUser {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (\Auth::check()) {
            $user = \Auth::user();
            if ($user->isBanned()) {
                \Auth::logout();
                if ($request->ajax()) {
                    return response('Unauthorized.', 401);
                } else {
                    return redirect('/');
                }
            }
        }
        return $next($request);
    }
}